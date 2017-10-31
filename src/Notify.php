<?php

namespace RulWeb\Notify;

use Illuminate\Session\Store;

/**
 * Class Notify
 * @method \RulWeb\Notify\Notify title($value)
 * @method \RulWeb\Notify\Notify text($value)
 * @method \RulWeb\Notify\Notify clickToHide($value)
 * @method \RulWeb\Notify\Notify autoHide($value)
 * @method \RulWeb\Notify\Notify autoHideDelay($value)
 * @method \RulWeb\Notify\Notify arrowShow($value)
 * @method \RulWeb\Notify\Notify arrowSize($value)
 * @method \RulWeb\Notify\Notify position($value)
 * @method \RulWeb\Notify\Notify elementPosition($value)
 * @method \RulWeb\Notify\Notify globalPosition($value)
 * @method \RulWeb\Notify\Notify style($value)
 * @method \RulWeb\Notify\Notify className($value)
 * @method \RulWeb\Notify\Notify showAnimation($value)
 * @method \RulWeb\Notify\Notify showDuration($value)
 * @method \RulWeb\Notify\Notify hideAnimation($value)
 * @method \RulWeb\Notify\Notify hideDuration($value)
 * @method \RulWeb\Notify\Notify gap($value)
 * @package RulWeb\Notify
 */
class Notify
{
    /**
     * @var Store
     */
    public $session;

    private $title = '';
    private $text = '';
    private $image = '';

    private $options = [
        // whether to hide the notification on click
        'clickToHide' => true,
        // whether to auto-hide the notification
        'autoHide' => true,
        // if autoHide, hide after milliseconds
        'autoHideDelay' => 5000,
        // show the arrow pointing at the element
        'arrowShow' => true,
        // arrow size in pixels
        'arrowSize' => 5,
        // position defines the notification position though uses the defaults below
        'position' => '...',
        // default positions
        'elementPosition' => 'bottom left',
        'globalPosition' => 'top right',
        // default style
        'style' => 'metro',
        // default class (string or [string])
        'className' => 'error',
        // show animation
        'showAnimation' => 'slideDown',
        // show animation duration
        'showDuration' => 400,
        // hide animation
        'hideAnimation' => 'slideUp',
        // hide animation duration
        'hideDuration' => 200,
        // padding between element and notification
        'gap' => 2
    ];

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function __call($option, $args)
    {
        if($option === 'title') {
            $this->title = $args[0];
        } else if($option === 'text') {
            $this->text = $args[0];
        } else {
            $this->options[$option] = $args[0];
        }

        $this->flash();

        return $this;
    }

    /**
     * @return void
     */
    public function flash()
    {
        $this->session->flash('notify.title', $this->title);
        $this->session->flash('notify.text', $this->text);
        $this->session->flash('notify.image', $this->image);
        $this->session->flash('notify.options', json_encode($this->options, JSON_UNESCAPED_UNICODE));
    }

    public function error($title, $text = null)
    {
        $this->message($title, $text, 'error');

        return $this;
    }

    public function message($title, $text, $type = null)
    {
        $this->title = $title;
        $this->text = $text;

        switch ($type) {
            case "error":
                $this->image = '<i class="fa fa-exclamation"></i>';
                break;
            case "warning":
                $this->image = '<i class="fa fa-warning"></i>';
                break;
            case "success":
                $this->image = '<i class="fa fa-check"></i>';
                break;
            case "custom":
                $this->image = '<i class="mdi mdi-album"></i>';
                break;
            case "info":
                $this->image = '<i class="fa fa-question"></i>';
                break;
            default:
                $this->image = '<i class="fa fa-adjust"></i>';
        }

        $this->options['className'] = $type;

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

    public function custom($title, $text = null)
    {
        $this->message($title, $text, 'custom');

        return $this;
    }
}