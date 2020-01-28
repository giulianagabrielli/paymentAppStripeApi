<?php

    class Transaction {

        private $db;

        //Create Constructor
        public function __construct(){

            //Instatiating object Database - pdo_db.php
            $this->db = new Database;
        }

        public function addTransaction($data){ //array with info

            //Prepare query
            $this->db->query('INSERT INTO transactions (id, customer_id, product, amount, currency, status) VALUES (:id, :customer_id, :product, :amount, :currency, :status)');

            //Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':customer_id', $data['customer_id']);
            $this->db->bind(':product', $data['product']);
            $this->db->bind(':amount', $data['amount']);
            $this->db->bind(':currency', $data['currency']);
            $this->db->bind(':status', $data['status']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getTransactions(){

            $this->db->query('SELECT * FROM transactions ORDER BY created_at DESC');

            $results = $this->db->resultset();

            return $results;
        }


    }