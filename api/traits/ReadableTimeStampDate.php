<?php

namespace api\traits;

/**
 * converts a models created_at and updated_at date to Y-m-d H:i:s format
 */
trait ReadableTimeStampDate {

    public function fields()
    {
        $fields = parent::fields();

        $fields['created_at'] = function($company) {
            return date('Y-m-d H:i:s', $company->created_at);
        };
        $fields['updated_at'] = function($company) {
            return date('Y-m-d H:i:s', $company->updated_at);
        };

        return $fields;
    }
}