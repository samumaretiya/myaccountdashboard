<?php
/**
 * Copyright © 2023 SamUmaretiya. All rights reserved.
 * Skype: samumaretiya
 * Email: samumaretiya@gmail.com
**/

namespace Zealouscommerce\MyAccountDashboard\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Linklist  implements ArrayInterface 
{
    public function toOptionArray()
    {
        return [
            ['value' =>'Account Information', 'label' => __('Account Information')],
            ['value' =>'Address Book', 'label' => __('Address Book')],
            ['value'=>'My Orders','label' => __('My Orders')],
            ['value'=>'My Downloadable Products','label' => __('My Downloadable Products')],
            ['value'=>'Stored Payment Methods','label' => __('Stored Payment Methods')],
            ['value'=>'My Product Reviews','label' => __('My Product Reviews')],
            ['value'=>'Newsletter Subscriptions','label' => __('Newsletter Subscriptions')],
            ['value'=> 'None','label'=>__('None')]
        ];
    }
}