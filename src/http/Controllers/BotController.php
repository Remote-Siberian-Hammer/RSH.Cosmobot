<?php

namespace Http\Controllers;

use Repository\DomCacheRepository;
use Twig\Environment;


class BotController
{
    private Environment $_view;

    public function __construct(Environment $view)
    {
        $this->_view = $view;
    }

    public function get_creator()
    {
        return $this->_view->render('bot/constructor.twig', []);
    }

    public function post($documentManager)
    {
        // $cookies = array();

        // foreach ($_COOKIE as $key => $value)
        // {
        //     $cookies[$key] = $key ."===" . $value;
        // }

        // $domdoc = new DOMDocument();
        //$domdoc->loadHTMLFile
        
        if (!isset($_COOKIE["user_id"]))
        {
          $repo = new DomCacheRepository();

          $repo->cache($documentManager, $this->getClientIp()["ip"], $this->_view->render("bot/constructor.twig", []));

          // $httpDom = new Dom();

          // $httpDom->setIp($this->getClientIp()["ip"]);
          // $httpDom->setDom($this->_view->render("bot/constructor.twig", []));

          // $documentManager->persist($httpDom);
          // $documentManager->flush();

          return "ABC";
        }
    }

    private function getClientIp() {
        $ip = '';
        $ipAll = []; // networks IP
        $ipSus = []; // suspected IP
        $serverVariables = [
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_X_COMING_FROM',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'HTTP_COMING_FROM',
            'HTTP_CLIENT_IP',
            'HTTP_FROM',
            'HTTP_VIA',
            'REMOTE_ADDR',
        ];
        foreach ($serverVariables as $serverVariable) {
          $value = '';
          if (isset($_SERVER[$serverVariable])) {
            $value = $_SERVER[$serverVariable];
          } elseif (getenv($serverVariable)) {
            $value = getenv($serverVariable);
          }
          if (!empty($value)) {
            $tmp = explode(',', $value);
            $ipSus[] = $tmp[0];
            $ipAll = array_merge($ipAll, $tmp);
          }
        }
        $ipSus = array_unique($ipSus);
        $ipAll = array_unique($ipAll);
        $ip = (sizeof($ipSus) > 0) ? $ipSus[0] : $ip;
        return [
          'ip' => $ip,
          'suspected' => $ipSus,
          'network' => $ipAll,
        ];
      }
}
