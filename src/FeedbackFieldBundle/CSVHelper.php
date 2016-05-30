<?php

namespace FeedbackFieldBundle;


/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class CSVHelper
{

  public static function getCell($in) {
    return '"'. str_replace(array('"'), array('""'),$in) .'"';
  }


}
