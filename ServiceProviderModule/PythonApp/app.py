from flask import Flask, render_template, request, redirect
from flask_mysqldb import MySQLdb
from werkzeug.security import generate_password_hash, check_password_hash

app = Flask(__name__)

conn = MySQLdb.connect("localhost","root","","webtekfinals")
cursor = conn.cursor()

@app.route('/')
def index():
	return render_template('dashboard.html')


#===========================View UnAnswered Requests====================
@app.route('/ansReq')
def ansReq():
	query = "CREATE OR REPLACE VIEW serviceInfo AS SELECT requested_by,idrequest,service_name,service_description,request_date,time_needed,status FROM request NATURAL JOIN services where status = 'pending' ;CREATE OR REPLACE VIEW Customer AS SELECT idUser, CONCAT(firstName, ' ', lastName) AS requesBy FROM request INNER JOIN user_details ON requested_by = idUser;"
	cursor.execute(query)

	query2 = "SELECT idrequest, service_name, service_description, request_date, time_needed, status, requesBy FROM serviceInfo NATURAL JOIN Customer group by 1;"
	cursor.execute(query2)

	data = cursor.fetchall()

	return render_template("viewRequests/ansReq.html", data=data)
	cursor.close()	
	conn.close()

#View Answered Request
@app.route('/viewAnswReq')
def viewAnsReq():
	query = "CREATE OR REPLACE VIEW serviceInfo AS SELECT requested_by,idrequest,service_name,service_description,request_date,time_needed,status FROM request NATURAL JOIN services where status = 'reject' OR status ='approve' ;CREATE OR REPLACE VIEW Customer AS SELECT idUser, CONCAT(firstName, ' ', lastName) AS requesBy FROM request INNER JOIN user_details ON requested_by = idUser;"
	cursor.execute(query)

	query2 = "SELECT idrequest, service_name, service_description, request_date, time_needed, status, requesBy FROM serviceInfo NATURAL JOIN Customer group by 1;"
	cursor.execute(query2)

	data = cursor.fetchall()

	return render_template("viewRequests/viewUnAnsReq.html", data=data)
	cursor.close()	
	conn.close()

#Reject the Request
@app.route('/addReqReject',methods =['POST'])
def addReqReject():
	idReq = request.form['reject']
	errors = 0

	try:

 		query = "UPDATE request SET status='reject', updated_at=NOW() WHERE idrequest='%s';" %idReq
 		cursor.execute(query)	
 		conn.commit();
 		return redirect("/ansReq")

	except (MySQLdb.Error, MySQLdb.Warning):
 		errors = errors +1
 		return 'Request not found'

	cursor.close()
	conn.close()

#Accept the Request
@app.route('/addReqSuccess',methods =['POST'])
def addReqSuccess():
	idReq = request.form['accept']
	errors = 0

	try:

 		query = "UPDATE request SET status='approve', updated_at=NOW() WHERE idrequest='%s';" %idReq
 		cursor.execute(query)	
 		

 		query2 = "SELECT requested_by,requested_to,service_id from request WHERE idrequest = '%s';" %idReq
 		cursor.execute(query2)
 		reqRow = cursor.fetchone()

 		cust = reqRow[0]
 		servprov = reqRow[1]
 		servId = reqRow[2]

 		query3 = "INSERT INTO transaction (service_id, transaction_status, sp_id, cust_id, created_at, updated_at) VALUES ('%s', 'ongoing', '%s', '%s', NOW(), NOW());" %(servId,servprov,cust)
 		cursor.execute(query3)

 		conn.commit();

 		return redirect("/ansReq")

	except (MySQLdb.Error, MySQLdb.Warning):
 		errors = errors +1
 		return 'Request not found'

	cursor.close()	
	conn.close()
#=========================================================================



#====================================Edit Transaction======================
@app.route('/editTrans')
def editTrans():
    query = "SELECT transaction_id, service_name, transaction_status, CONCAT(firstname, ' ', lastname) AS 'name' FROM transaction t LEFT JOIN services s ON t.service_id = s.service_id LEFT JOIN user_details ON idUser = cust_id where transaction_status = 'ongoing' GROUP BY transaction_id , service_name , name;"
    cursor.execute(query)
    chabal = cursor.fetchall()
    
    return render_template('transactions/editTrans.html', ako=chabal)
    cursor.close()
    conn.close()

    
@app.route('/TransSuccess', methods = ['POST'])
def TransSuccess():
    
    idtran = request.form['babyrandall']
    query = "UPDATE transaction SET transaction_status='done' WHERE transaction_id='%s';" %idtran
    cursor.execute(query)
    
    return redirect('/editTrans')
    
    conn.commit()
    cursor.close()
    conn.close()	

@app.route('/showAnsTrans')
def showAnsTrans():
    query = "SELECT transaction_id, service_name, transaction_status, CONCAT(firstname, ' ', lastname) AS 'name' FROM transaction t LEFT JOIN services s ON t.service_id = s.service_id LEFT JOIN user_details ON idUser = cust_id where transaction_status = 'done' GROUP BY transaction_id , service_name , name;"
    cursor.execute(query)
    chabal = cursor.fetchall()
    
    return render_template('transactions/showAnsTrans.html', ako=chabal)
    cursor.close()
    conn.close()
#==========================================================================

#======================VIEW PROFILE========================================

@app.route('/viewprofile')
def viewprofile():
	query = "SELECT * from user_details"
	cursor.execute(query)	
	data = cursor.fetchall()
	conn.commit()

	query1 = "SELECT * from services"
	cursor.execute(query1)	
	data1 = cursor.fetchall()
	conn.commit()

	query2 = "SELECT * from transaction"
	cursor.execute(query2)	
	data2 = cursor.fetchall()
	conn.commit()

	return render_template('viewprofile.html', data=data,data1=data1,data2=data2)

	cursor.close()
	conn.close()
#======================VIEW FEEDBACKS========================================
@app.route('/viewfeedbacks')
def view():
	sql = "select * from feedback"
	cursor.execute(sql)
	feedbacks = cursor.fetchall()

	return render_template('viewFeedbacks.html', feedbacks=feedbacks)
	conn.close()
#======================ADD SERVICE========================================

@app.route('/addservice')
def add():
	return render_template('addServices.html')

@app.route('/addservices', methods = ['POST'])
def addservice():
	
	serviceName = request.form['servicename']
	serviceDesc = request.form['servicedesc']

	errors = 0

	try:
		query = "INSERT INTO services (service_name, created_at, service_description, sp_id) VALUES ('%s', NOW(), '%s', '6')" %(serviceName, serviceDesc)
		cursor.execute(query)

	except (MySQLdb.Error, MySQLdb.Warning):
		errors = errors +1
		return 'error on user input'

	if errors == 0:
		conn.commit()
		return "Yeah"
	else:
		return "There was an error in requesting your acc"
	
	conn.close()
#======================DELETE SERVICE========================================
	
@app.route('/deleteservice')
def delete():

	query = "select * from services"
	cursor.execute(query)

	data = cursor.fetchall()
	return render_template('deleteServices.html', data = data)


@app.route('/deleteservices', methods = ['POST'])
def deleteServices():
	idService = request.form['delete']
	errors = 0

	try:	
		query = "DELETE FROM services WHERE services.service_id = '%s'" %idService
		cursor.execute(query)
		conn.commit()

	

	except (MySQLdb.Error, MySQLdb.Warning):
		errors = errors + 1
		return 'Request not found'

	if errors == 0:
		conn.commit()
		return "yeah"
	else:
		return "There was an error"

	cursor.close();
	conn.close()	
	

if __name__ == '__main__':
	app.run(host='localhost', debug=True)
