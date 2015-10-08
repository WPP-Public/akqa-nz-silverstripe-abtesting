<?php

/**
 * Class ABTestingPageExtension
 */
class ABTestingPageExtension extends DataExtension
{

    public static $db = array(
        'ABTestPage' => 'Boolean',
        'ABTestInlineScript' => 'Text'
    );

    /**
     * Update the CMS fields on the extended object
     *
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {

        $member = Member::currentUser();

        // lock down testing for heyday developers only
        if ($member->Email == Email::getAdminEmail()) {

            $fields->addFieldToTab(
                'Root.ABTesting',
                new CheckboxField('ABTestPage', 'This is a page currently undergoing AB testing.')
            );
            $fields->addFieldToTab(
                'Root.ABTesting',
                new TextareaField('ABTestInlineScript', 'Inline Script for AB Testing (from Google content experiments)')
            );

        }

    }

    /**
     * Provide a way to get the required script for AB testing into the template engine
     *
     * @return mixed
     */
    public function getABTestScript()
    {

        if ($this->owner->ABTestPage) {

            if ($this->owner->ABTestInlineScript) {

                $html = new HTMLText();
                $html->setValue($this->owner->ABTestInlineScript);
                return $html;

            }

        }

        return false;

    }

}