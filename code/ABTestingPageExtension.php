<?php

/**
 * Class ABTestingPageExtension
 */
class ABTestingPageExtension extends Extension
{

    /**
     * Required for DataObject extensions
     *
     * @return array
     */
    public function extraStatics()
    {
        return array(
            'db' => array(
                'ABTestPage' => 'Boolean',
                'ABTestInlineScript' => 'HTMLText'
            )
        );
    }

    /**
     * Update the CMS fields on the extended object
     *
     * @param FieldSet $fields
     */
    public function updateCMSFields(FieldSet &$fields)
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

                return $this->owner->ABTestInlineScript;

            }

        }

        return false;

    }

}