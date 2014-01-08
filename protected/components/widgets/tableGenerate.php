<?php

class TableGenerate extends CWidget {

    public $settings = array();
    public $columns = array();
    public $offset = 0;
    public $totalCount = 0;
    public $datas = array();

    public function init() {
        $settings = array(
            'displayLength' => 5,
            'showPage' => 5,
            'requsetSource' => '#',
        );
        $this->settings = array_merge($settings, $this->settings);
    }

    public function run() {
        $this->render('tableGenerate');
    }

}