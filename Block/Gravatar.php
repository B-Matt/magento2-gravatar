<?php
namespace Matej\Gravatar\Block;

class Gravatar extends \Magento\Framework\View\Element\Template
{
    protected $_isUsingSecure   = false;
    protected $_size            = 80;
    protected $_defaultImage    = 'mm';
    protected $_rating          = 'g';

    /*
     * Constructor
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context
    )
    {
        parent::__construct($context);
    }

    /*
     * Set functions
     */
    public function setGravatarSize($size)
    {
        if(!is_int($size) && !ctype_digit($size))
        {
            $this->_size = 80;
        } else {
            $this->_size = $size;
        }
        return $this;
    }

    public function setGravatarSecured($isSecure)
    {
        $this->_isUsingSecure = $isSecure;
        return $this;
    }

    public function setGravatarDefaultImage($image, $custom)
    {
        if(!$custom) {
            $defaultImages = array('mm', 'identicon', 'monsterid', 'wavatar',  'retro', 'blank');
            if (in_array($image, $defaultImages))
                $this->_defaultImage = $image;//$defaultImages[array_search($image, $defaultImages)];
        } else {
            if(filter_var($image, FILTER_VALIDATE_URL))
                $this->_defaultImage = rawurlencode($image);
        }
        return $this;
    }

    public function setGravatarRating($rating)
    {
        $ratings   = array('g', 'pg', 'r', 'x');
        if(in_array($rating, $ratings))
            $this->_rating = $rating;
        return $this;
    }

    /*
     * Create Function
     */
    public function getGravatarURL($email)
    {
        $http     = 'http://www.gravatar.com/avatar/';
        $https    = 'https://secure.gravatar.com/avatar/';
        $url = ($this->_isUsingSecure ? $https : $http);

        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $url .= hash('md5', strtolower(trim($email)));
            $url .= "?s=" . $this->_size;
            $url .= "&amp;r=" . $this->_rating;
            $url .= "&amp;d=" . $this->_defaultImage;
        } else {
            $url .= str_repeat('0', 32) . '?d=' . $this->_defaultImage . "&amp;s=" . $this->_size .  "&amp;r=" . $this->_rating;
        }
        return $url;
    }

    public function getGravatarById($id)
    {
        $customerMail = 'none';
        if(!is_null($id)) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $customerMail = $objectManager->get('\Magento\Customer\Api\CustomerRepositoryInterface')->getById($id)->getEmail();
        }
        return $this->setGravatarSize(60)->getGravatarURL($customerMail);
    }
}