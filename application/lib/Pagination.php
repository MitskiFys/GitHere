<?php

namespace application\lib;

class Pagination {
    
    private $max = 10;
    private $route;
    private $index = '';
    private $current_page;
    private $total;
    private $limit;

    public function __construct($route, $total, $limit = 10) {
        $this->route = $route;//скидываем url
        $this->total = $total;//всего постов
        $this->limit = $limit;//постов на странице
        $this->amount = $this->amount();//количество страниц
        $this->setCurrentPage();
    }
   
    public function get() {
        $links = null;//пустота
        $limits = $this->limits();//устанавливаем количстево постов на странице
        //debug($limits);
        $html = '<nav><ul class="pagination">';
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            if ($page == $this->current_page) {
                $links .= '<li class="page-item active"><span class="page-link">'.$page.'</span></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }
        if (!is_null($links)) {
            if ($this->current_page > 1) {
                $links = $this->generateHtml(1, 'Вперед').$links;
            }
            if ($this->current_page < $this->amount) {
                $links .= $this->generateHtml($this->amount, 'Назад');
            }
        }
        $html .= $links.' </ul></nav>';
        return $html;
    }

    private function generateHtml($page, $text = null) {
        if (!$text) {
            $text = $page;
        }
        //debug('<li class="page-item"><a class="page-link" href="/'.$this->route['controller'].'/'.$this->route['action'].'/'.$page.'">'.$text.'</a></li>');
        return '<li class="page-item"><a class="page-link" href="/'.$this->route['controller'].'/'.$this->route['action'].'/'.$page.'">'.$text.'</a></li>';
    }

    private function limits() {
        $left = $this->current_page - round($this->max / 2);//3-4=-1
        $start = $left > 0 ? $left : 1;//если левосторонний предел больше нуля, то старт равен лефт, или равен 1 start =1
        if ($start + $this->max <= $this->amount) {//если стар+максимум страниц меньше или равен общему количеству страниц
            $end = $start > 1 ? $start + $this->max : $this->max;//то конец равен старт+10 или же равен 10
        }
        else {
            $end = $this->amount;
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }
        return array($start, $end);
    }

    private function setCurrentPage() {
        if (isset($this->route['page'])) {//смотри на количество страниц в ссылке
            $currentPage = $this->route['page'];//выставляет текущую страницу, если не пустота
        } else {
            $currentPage = 1;//инчае это первая страница
        }
        $this->current_page = $currentPage;//ставим глобальную(для этого класса переменную) текущую страницу
        if ($this->current_page > 0) {//если текущая страница больше 0
            if ($this->current_page > $this->amount) {//если текущее количсетво больше чем возможно
                $this->current_page = $this->amount;//то меняем текущую на максимально возможную
            }
        } else {
            $this->current_page = 1;//или текущая страница равна 1
        }
    }

    private function amount() {
        return ceil($this->total / $this->limit);//количество страниц
    }
}