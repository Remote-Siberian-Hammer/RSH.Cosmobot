<?php

namespace Http\Controllers;

use Repository\DomCacheRepository;
use Twig\Environment;


class BotController
{
    private Environment $_view;
    private DomCacheRepository $_domCacheRepository;

    public function __construct(Environment $view, DomCacheRepository $domCacheRepository)
    {
        $this->_view = $view;
        $this->_domCacheRepository = $domCacheRepository;
    }

    public function get_creator()
    {
        return $this->_view->render('bot/constructor.twig', []);
    }

    public function post($documentManager)
    {
        if (!isset($_COOKIE["user_id"]))
        {
          $this->_domCacheRepository->cache($documentManager, $this->getClientIp()["ip"], $this->_view->render("bot/constructor.twig", []));

          return "Пользователь не был авторизован. Предыдущая страница кэширована";
        }

        return "Пользователь был авторизован";
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
