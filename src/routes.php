<?php

Route::group(
    array(
        'prefix' => "admin",
        'before' => array('auth_admin', 'check_permissions')
    ), function () {

        Route::any(
            'settings/letter', array(
                'as' => 'letter_all',
                'uses' => 'Vis\MailTemplates\MailController@fetchIndex'
            )
        );

        if (Request::ajax()) {
            Route::post(
                'emails/create_pop', array(
                    'as' => 'created_email',
                    'uses' => 'Vis\MailTemplates\MailController@fetchCreate'
                )
            );
            Route::post(
                'emails/add_record', array(
                    'as' => 'add_email',
                    'uses' => 'Vis\MailTemplates\MailController@doSave'
                )
            );
            Route::post(
                'emails/delete', array(
                    'as' => 'delete_email',
                    'uses' => 'Vis\MailTemplates\MailController@doDelete'
                )
            );
            Route::post(
                'emails/edit_record', array(
                    'as' => 'edit_email',
                    'uses' => 'Vis\MailTemplates\MailController@fetchEdit'
                )
            );
        }
    }
);


