<?php

/**
 * エラーハンドリングの設定です.
 *
 */


// エラー画面を表示しない
ini_set("display_errors", 0);
ini_set("display_startup_errors", 0);

// 全てのエラーを表示する
// @see http://php.net/manual/ja/function.error-reporting.php
error_reporting(-1);


// ----------------------------------------
// エラー発生時に例外を発行する
// 
// @see http://php.net/manual/ja/function.set-error-handler.php
// 
set_error_handler(function($errno, $errstr, $errfile, $errline){
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});
//muteExpectedErrors();


// ----------------------------------------
// スクリプト終了時にエラーが発生していた時のハンドリング
// 
// @see http://php.net/manual/ja/function.register-shutdown-function.php
// 
register_shutdown_function(
    function() {
        $e = error_get_last();
		// set_error_handler で補足できないエラーを補足する
        if(    $e['type'] == E_ERROR
            || $e['type'] == E_PARSE
            || $e['type'] == E_CORE_ERROR
            || $e['type'] == E_COMPILE_ERROR
            || $e['type'] == E_USER_ERROR ){

			// ----------------------------------------
			// 致命的なエラー時の処理
			// 

            echo "致命的なエラーが発生しました。\n";
			var_dump($e);

			//
			// ----------------------------------------
        }
    }
);

