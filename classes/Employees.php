<?php

namespace classes;

use mysqli;

class Employees{

    function __construct()
    {
        $this->connection = new mysqli('localhost', 'root', 'sunyika5', 'employees');
        if($error = $this->connection->error){
            exit($error);
        }
    }



    function get($from=0){
        header('Contet-Type: application/json');
        $result = [];
        $ob = $_GET['ob'];
        if($ob == 'id'){
            $ob = 'employees.emp_no';
        }
        elseif($ob == 'name'){
            $ob = 'employees.first_name';
        }
        elseif($ob == 'department'){
            $ob = 'titles.title';
        }
        elseif($ob == 'class'){
            $ob = 'departments.dept_name';
        }
        elseif($ob == 'date'){
            $ob = 'employees.hire_date';
        }
        else{
            exit;
        }

        $kw = $_GET['kw'];

        $sql = $this->connection->query("select count(employees.emp_no) as n from employees");
        $record_number = $sql->fetch_object();
        $record_number = $record_number->n;

        $sql = $this->connection->query("select employees.*, 
        salaries.*,
        dept_emp.*,
        titles.*,
        departments.*
        from employees, salaries, dept_emp, titles,departments
        where 
        (employees.emp_no = salaries.emp_no 
        and 
        employees.emp_no = dept_emp.emp_no 
        and 
        employees.emp_no = titles.emp_no
        and
        departments.dept_no = dept_emp.dept_no)
        ".(($kw)?"
            and ( 
                employees.first_name like '%".$kw."%' 
                or
                titles.title like '%".$kw."%'
                or 
                departments.dept_name like '%".$kw."%'
                or
                employees.hire_date  like '%".$kw."%'
            )   
        ":"")."

        group by employees.emp_no order by $ob limit 20 offset $from");
        while($user = $sql->fetch_object()){
            $result[] = $user;
        }
        print(json_encode(['result'=>$result,
        'record_number'=>$record_number], true));
    }

    function update(){
        $sql = $this->connection->query('update employees set
        birth_date = $birth_date,
        first_name = $first_name,
        last_name = $last_name where birth_date, first_name, last_name');
    }

    function delete($id){

      $this->connection->begin_transaction();
        try{
            $this->connection->query('delete from employees where emp_no='.(int)$id);
            $this->connection->query('delete from salaries where emp_no='.(int)$id);
            $this->connection->query('delete from titles where emp_no='.(int)$id);
            $this->connection->query('delete from dept_manager where emp_no='.(int)$id);
            $this->connection->query('delete from dept_emp where emp_no='.(int)$id);

            $this->connection->commit();
        }catch(\Exception $e){
            $this->connection->rollback();
            exit($e);
        }

       
       
    }


}