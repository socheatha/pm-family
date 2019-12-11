create view `view_transaction` as 
SELECT *,
	(SELECT SUM(so_cost*qty_out) FROM tbl_pos_stockout WHERE invoice=A.t_id ) AS sum_cost,
	((A.t_fix_price*A.t_discount_percentage/100)+A.t_discount_dollar) as sum_discount,
	t_fix_price - ((A.t_fix_price*A.t_discount_percentage/100)+A.t_discount_dollar) as total,
	t_fix_price - ((A.t_fix_price*A.t_discount_percentage/100)+A.t_discount_dollar) - (SELECT SUM(so_cost*qty_out) FROM tbl_pos_stockout WHERE invoice=A.t_id ) as profit
FROM tbl_transaction AS A 
	LEFT JOIN tbl_pos_service AS D ON D.s_id=A.t_issue
	LEFT JOIN tbl_fix_type AS E ON E.ft_id=A.t_fix_status
	LEFT JOIN tbl_machine_type AS G ON G.mt_id=A.t_product_machine_type
	LEFT JOIN tbl_pos_employee AS H ON H.emp_id=A.t_fix_by_employee
	LEFT JOIN tbl_pos_product_model AS I ON I.pro_id=A.t_product_model
ORDER BY A.t_date_received ASC