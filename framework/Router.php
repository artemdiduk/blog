<?php
namespace Framework;

class Router
{
    private $router = [];

    public function getRouter(): array
    {
        return $this->router;
    }
    public function modelParse($data) {
        $model = $data['models'];
        $sign = $data['read'];
        $controller = $data['controller'];
        $result = $model->getDefinitionData($sign);
        foreach($result as $parseData) {
            $this->setRout($parseData[$sign], $controller);
        }
    }
    public function setRout($url, $controller, $params = null)
    {
        $this->router[] = [
            "url" => $url,
            'controller' => $controller,
            'params' =>  $params,
        ];

        $this->startRouts();
    }
    public function startRouts() {
        $page = $request = (isset($_GET['q']) ? $_GET['q'] : '/');
        foreach ($this->router as $item) {
           if($item['url'] == $page) {
               $controller = $item['controller'];
               $controller->page($item['url']);
               die();
           }
        }
    }
}   
