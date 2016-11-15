<?php


namespace FeedbackFieldBundle\Twig;

class FiltersDatesExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('FiltersDatesMonthly', array($this, 'filtersDatesMonthly')),
        );
    }

    public function filtersDatesMonthly()
    {

        $out = array();

        $create = new \DateTime();
        $subInterval = new \DateInterval("P1M");

        for ($i = 1; $i <= 4; $i++) {


            $from = clone $create;
            $from->setTime(0,0,0);
            $from->setDate($from->format("Y"), $from->format("m"), 1);

            $to = clone $create;
            $to->setTime(23,59,59);
            $to->setDate($from->format("Y"), $from->format("m"), cal_days_in_month(CAL_GREGORIAN, $from->format("m"), $from->format("Y")));

            $out[] = array(
                'label' => $create->format("M Y"),
                'from' => $from,
                'to' => $to,
            );

            $create->sub($subInterval);
        }


        return $out;
    }

    public function getName()
    {
        return 'FiltersDatesExtension';
    }
}

