<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use ZipArchive;

class LandingPageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['lpCreate'],
                    ],
                    [
                        'allow' => false,
                    ],
                ],
            ],
        ];
    }

    public function actionDesigner()
    {
        $get = Yii::$app->request->get();
        $templ_dir = __DIR__ . '/../web/lp/templates';
        // Step 2
        if (count($get)) {
            if (
                !array_key_exists('t', $get) ||
                !is_dir($templ_dir . '/' . (integer)$get['t']) ||
                !is_file($templ_dir . '/' . (integer)$get['t'] . '/index.html') ||
                !is_file($templ_dir . '/' . (integer)$get['t'] . '/preview.png')
            ) {
                throw new NotFoundHttpException();
            }

            return $this->render(
                'designer_s2',
                [
                    'template' => '/lp/templates/' . (integer)$get['t'] . '/index.html',
                ]
            );
        }

        // Step 1
        $templates = [];
        foreach (scandir($templ_dir) as $template) {
            if ($template !== '.' && $template !== '..') {
                $templates[] = $template;
            }
        }

        return $this->render(
            'designer',
            [
                'templates' => $templates,
            ]
        );
    }

    public function actionTemplate()
    {
        $this->layout = 'empty';
        $url = $_SERVER['REQUEST_URI'];
        $url = str_replace('../', '', $url);
        $url = str_replace('?' . $_SERVER['QUERY_STRING'], '', $url);
        $url = dirname(__DIR__) . '/web' . $url;

        if (is_file($url)) {
            $file_name = basename($url);
            $file = file_get_contents($url);
            if ($file_name == 'index.html') {
                $ex = explode('/', $url);
                return $this->render(
                    'template',
                    [
                        'template' => $file,
                        'template_id' => (integer)$ex[7],
                    ]
                );
            } else {
                $path = pathinfo($url);
                switch ($path['extension']) {
                    case 'css':
                        header('Content-Type: text/css');
                        break;

                    case 'js':
                        header('Content-Type: text/javascript');
                        break;

                    default:
                        header('Content-Type: ' . mime_content_type($url));
                }

                echo $file;
            }
        }

        throw new NotFoundHttpException();
    }

    private function getFiles($dir)
    {
        $files = [];
        foreach (scandir($dir) as $file_name) {
            if ($file_name === '.' || $file_name === '..') {
                continue;
            }

            $file = $dir . '/' . $file_name;
            if (is_dir($file)) {
                $files = array_merge($files, $this->getFiles($file));
            } else {
                $files[] = $file;
            }
        }

        return $files;
    }

    public function actionDownload()
    {
        $post = Yii::$app->request->post();
        if (!count($post) || !array_key_exists('export-textarea', $post)) {
            return;
        }

        $template = $post['export-textarea'];
        $ex = explode('<!--lp_dellme_block-->', $template);

        $template = str_replace($ex[1], '', $template);
        $template = str_replace('<!--lp_dellme_block-->', '', $template);
        $template = str_replace('&lt;', '<', $template);
        $template = str_replace('&gt;', '>', $template);
        $template = str_replace('/lp/templates/' . (integer)$post['templ_id'] . '/', '', $template);

        $dir = __DIR__ . '/../web/lp/templates/' . (integer)$post['templ_id'];
        $files = $this->getFiles($dir);

        $file = tempnam('/tmp', 'zip');
        $zip = new ZipArchive();
        $zip->open($file, ZipArchive::OVERWRITE);

        foreach ($files as $filee) {
            $new_name = str_replace($dir . '/', '', $filee);
            if ($new_name === 'preview.png') {
                continue;
            }

            $zip->addFile(
                $filee,
                $new_name
            );
        }

        $zip->addFromString('index.html', $template);
        $zip->close();

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Length: ' . filesize($file));
        header("Content-Disposition: attachment;filename=template.zip");
        header("Content-Transfer-Encoding: binary ");
        readfile($file);
        unlink($file);
    }
}
