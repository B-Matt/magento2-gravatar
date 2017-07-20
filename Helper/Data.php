<?php
namespace Matej\Gravatar\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    public static function getCustomerAvatarById($id)
    {
        $block = \Magento\Framework\App\ObjectManager::getInstance()->create('Matej\Gravatar\Block\Gravatar');
        return $block->getGravatarById($id);
    }

    public static function getCustomerAvatarByMail($email)
    {
        $block = \Magento\Framework\App\ObjectManager::getInstance()->create('Matej\Gravatar\Block\Gravatar');
        return $block->getGravatarURL($email);
    }
}