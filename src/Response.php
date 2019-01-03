<?php
namespace Mickeyto\Curl;

class Response
{
    public $errno = 0;
    public $error = '';
    public $info = [];
    public $content;
    public $ch;

    public function __construct($resource, $content)
    {
        $this->ch = $resource;
        $this->setContent($content);
        $this->setErrno();
        $this->setError();
        $this->setInfo();
        $this->closeResource();
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setErrno()
    {
        $code = curl_errno($this->ch);
        $this->errno = $code;
    }

    public function getErrno():int
    {
        return $this->errno;
    }

    public function setError()
    {
        $error = curl_error($this->ch);
        $this->error = $error;
    }

    public function getError():string
    {
        return $this->error;
    }

    public function setInfo()
    {
        $data = curl_getinfo($this->ch);
        $this->info = $data;
    }

    public function getInfo():array
    {
        return $this->info;
    }

    public function closeResource()
    {
        curl_close($this->ch);
    }

}