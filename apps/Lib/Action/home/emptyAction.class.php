<?php
/**
 * 404错误 
 */
class emptyAction extends Action {
    public function _empty() {
        send_http_status(404);
        $this->display(TMPL_PATH . '404.tpl');
    }
}