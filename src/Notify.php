<?php

namespace RulWeb\Notify;

use Illuminate\Session\Store;

/**
 * Class Notify
 * @method \RulWeb\Notify\Notify title($value)
 * @method \RulWeb\Notify\Notify text($value)
 * @method \RulWeb\Notify\Notify type($value)
 * @method \RulWeb\Notify\Notify icon($value)
 * @method \RulWeb\Notify\Notify addclass($value)
 * @package App\Ext\Notify
 */
class Notify
{
    /**
     * @var Store
     */
    public $session;

    public $options = [
        'title' => null,
        'text' => null,
        'type' => null,
        'icon' => null,
        'addclass' => null,
    ];

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function __call($option, $args)
    {
        $this->options[$option] = $args[0];
        $this->flash();

        return $this;
    }

    /**
     * @return void
     */
    public function flash()
    {
        $this->session->flash('notify', json_encode($this->options, JSON_UNESCAPED_UNICODE));
    }

    public function error($title, $text = null)
    {
        $this->message($title, $text, 'error');

        return $this;
    }

    public function message($title, $text, $type = null)
    {
        $this->options['title'] = $title;
        $this->options['type'] = $type;
        $this->options['text'] = $text;

        $this->flash();

        return $this;
    }

    public function info($title, $text = null)
    {
        $this->message($title, $text, 'info');

        return $this;
    }

    public function warning($title, $text = null)
    {
        $this->message($title, $text, 'warning');

        return $this;
    }

    public function success($title, $text = null)
    {
        $this->message($title, $text, 'success');

        return $this;
    }
}