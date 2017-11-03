select 	
	d.dept_name as departamento,
	concat(e.first_name," ",e.last_name) as nome_funcionario,    
	CASE 
    WHEN  de.to_date is null  THEN 
		DATEDIFF( CURDATE() , de.from_date ) 
    ELSE
		DATEDIFF(de.to_date, de.from_date)
	END as dias_trabalhados

FROM employees as e
left JOIN dept_emp de ON ( e.emp_no = de.emp_no)
left join departments d ON ( de.dept_no = d.dept_no)

order by dias_trabalhados desc,e.emp_no desc, d.dept_name
limit 10