<?php
/**
 * Created by PhpStorm.
 * User: vishalashar
 * Date: 5/2/16
 * Time: 12:01 PM
 */

    class LogView extends Page {
        public function createHtml() {
            $db_connection = DBConnection::getConnection();

            $get_attempts = $db_connection->prepare('SELECT * FROM `Logs`');
            $get_attempts->execute();

            $attempts = $get_attempts->fetchAll(PDO::FETCH_ASSOC);

            $html_table = new HtmlTable();
            $html_table->createLogsTable($attempts);

            $this->html .= $html_table->getTable();
        }
    }

?>