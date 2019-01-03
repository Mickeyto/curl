<?php
namespace Mickeyto\Curl;

class Request
{
    public $url = '';
    public $options = [
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_RETURNTRANSFER => true,
    ];

    /**
     * @param string $url
     */
    public function __construct(string $url='')
    {
        if(!empty($url)){
            $this->setUrl($url);
        }
    }

    /**
     * @param string $url
     * @return void
     */
    public function setUrl(string $url):void
    {
        $this->url = $url;
        $this->options[CURLOPT_URL] = $url;
    }

    public function setOpt(string $name, $value)
    {
        $this->options[$name] = $value;
    }

    public function setOptions(array $options)
    {
        $this->options = $this->options + $options;
    }

    public function getOptions():array
    {
        return $this->options;
    }

    /**
     * return Response
     */
    public function exec():Response
    {
        $ch = curl_init();
        curl_setopt_array($ch, $this->options);
        $content = curl_exec($ch);

        $response = new Response($ch, $content);
        return $response;
    }

}