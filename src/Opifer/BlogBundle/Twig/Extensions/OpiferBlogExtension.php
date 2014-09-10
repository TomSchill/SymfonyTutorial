<?php namespace Opifer\BlogBundle\Twig\Extensions;
class OpiferBlogExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('created_ago', array($this, 'createdAgo'))
        );
    }

    public function createdAgo(\DateTime $dateTime)
    {
        $delta = time() - $dateTime->getTimestamp();
        if($delta < 0)
            throw new \InvalidArgumentException("createdAgo is unable to handle dates in the future");

        $duration = "";
        if($delta < 60)
        {
            // Calculate Seconds
            $time = $delta;
            $duration = "Just now";
        }
        else if($delta < 3600)
        {
            // Calculate Minutes
            $time = floor($delta / 60);
            $duration = $time . " minute" . (($time > 1) ? "s" : "") . " ago";
        }
        else if($delta < 86400)
        {
            // Calculate Hours
            $time = floor($delta / 3600);
            $duration = $time . " hour" . (($time > 1) ? "s" : "") . " ago";
        }
        else if($delta < 2629743.83)
        {
            // Calculate Day
            $time = floor($delta / 86400);
            $duration = $time . " day" . (($time > 1) ? "s" : "") . " ago";
        }
        else if($delta < 31556926)
        {
            // Calculate Month
            $time = floor($delta / 2629743.83);
            $duration = $time . " month" . (($time > 1) ? "s" : "") . " ago";
        }
        else
        {
            // Calculate Year
            $time = floor($delta / 31556926);
            $duration = $time . " year" . (($time > 1) ? "s" : "") . " ago";
        }

        return $duration;
    }

    public function getName()
    {
        return 'opifer_blog_extension';
    }
}