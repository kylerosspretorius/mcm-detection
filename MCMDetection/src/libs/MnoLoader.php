<?php
/**
 * Created by PhpStorm.
 * User: kylepretorius
 * Date: 02/02/2018
 * Time: 10:50
 */

namespace MCM\MCMDetection\Libs;

class MnoLoader {


    /**
     * The array of actions registered with the package.
     *
     * @var array $actions The actions registered when the package is loaded.
     */
    protected $actions;

    /**
     * The array of filters registered with the package.
     *
     * @var array $filters The filters registered when the package is loaded.
     */
    protected $filters;

    /**
     * Initialize the collections used to maintain the actions and filters.
     */
    public function __construct()
    {
        $this->actions = array();
        $this->filters = array();
    }


    public function addAction($hook, $component, $callback, $priority = 10, $accepted_args = 1)
    {
        $this->actions = $this->add($this->actions, $hook, $component, $callback, $priority, $accepted_args);
    }

    public function addFilter($hook, $component, $callback, $priority = 10, $accepted_args = 1)
    {
        $this->filters = $this->add($this->filters, $hook, $component, $callback, $priority, $accepted_args);
    }

    /**
     * A utility function that is used to register the actions and hooks into a single
     * collection.
     *
     *
    **/
    private function add($hooks, $hook, $component, $callback, $priority, $accepted_args)
    {
        $hooks[] = array(
            'hook'          => $hook,
            'component'     => $component,
            'callback'      => $callback,
            'priority'      => $priority,
            'accepted_args' => $accepted_args,
        );

        return $hooks;
    }




}