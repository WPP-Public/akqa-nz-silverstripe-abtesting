<?php

/**
 * Class ABTestingConfigExtension
 */
class ABTestingConfigExtension extends Extension
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
                'ABGlobalTest' => 'Boolean',
                'ABTestGlobalScript' => 'Text'
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

        // lock down testing for the administrator only
        if ($member->Email == Email::getAdminEmail()) {

            $fields->addFieldToTab(
                'Root.ABTesting',
                new CheckboxField('ABGlobalTest', 'This site currently undergoing AB testing.')
            );
            $fields->addFieldToTab(
                'Root.ABTesting',
                new TextareaField('ABTestGlobalScript', 'Inline Script for AB Testing (from Google content experiments)')
            );

        }

    }

    /**
     * Provide a way to get the required script for AB testing into the template engine
     *
     * @return mixed
     */
    public function getABTestGlobalScript()
    {

        if ($this->owner->getField('ABGlobalTest') != 0) {

            if (!is_null($this->owner->getField('ABTestGlobalScript'))) {

                $html = new HTMLText();
                $html->setValue($this->owner->getField('ABTestGlobalScript'));

                return $html;

            }

        }

        return false;

    }

}