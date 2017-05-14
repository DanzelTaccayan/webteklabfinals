from flask import Flask, render_template, request, redirect, session
from flask_mysqldb import MySQLdb

app = Flask(__name__)

conn = MySQLdb.connect("localhost","root","","webtekfinals")
cursor = conn.cursor()
@app.route('/auth')
def auth():
	if request.args.get('username'):
		session['userID'] = request.args.get('username')
		return redirect('/')
	else:
		return redirect('/noAuth')

@app.route('/noAuth')
def noAuth():
	return redirect('http://192.168.0.116')

@app.route('/')
def index():
	if 'userID' in session:
		query1 = "Select firstName from user_details where idUser = '%s'" %session['userID']
		cursor.execute(query1)

		data1 = cursor.fetchone()
		return render_template('dashboard.html', data1=data1)

		cursor.close()
		conn.close()
	else:
		return redirect('/noAuth')

#===========================View UnAnswered Requests====================
@app.route('/ansReq')
def ansReq():
	if 'userID' in session:
	    query3 = "SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));"
	    cursor.execute(query3)
	    query = "CREATE OR REPLACE VIEW serviceInfo AS SELECT requested_by,idrequest,service_name,service_description,request_date,time_needed,status FROM request NATURAL JOIN services where status = 'pending' and requested_to = '%s';CREATE OR REPLACE VIEW Customer AS SELECT idUser, CONCAT(firstName, ' ', lastName) AS requesBy FROM request INNER JOIN user_details ON requested_by = idUser;" %session['userID']
	    cursor.execute(query)
	    
	    query2 = "SELECT idrequest, service_name, service_description, request_date, time_needed, status, requesBy FROM serviceInfo NATURAL JOIN Customer group by 1;"
	    cursor.execute(query2)
	    data = cursor.fetchall()
	    
	    return render_template("viewRequests/ansReq.html", data=data)
	    cursor.close()
	    conn.close()
	else:
		return redirect('/noAuth')

#View Answered Request
@app.route('/viewAnswReq')
def viewAnsReq():
	if 'userID' in session:
	    query3 = "SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));"
	    cursor.execute(query3)
	    query = "CREATE OR REPLACE VIEW serviceInfo AS SELECT requested_by,idrequest,service_name,service_description,request_date,time_needed,status FROM request NATURAL JOIN services where requested_to = '%s' AND (status = 'reject' OR status ='approve') ;CREATE OR REPLACE VIEW Customer AS SELECT idUser, CONCAT(firstName, ' ', lastName) AS requesBy FROM request INNER JOIN user_details ON requested_by = idUser;" %session['userID']
	    cursor.execute(query)
	    
	    query2 = "SELECT idrequest, service_name, service_description, request_date, time_needed, status, requesBy FROM serviceInfo NATURAL JOIN Customer group by 1;"
	    cursor.execute(query2)
	    
	    data = cursor.fetchall()
	    
	    return render_template("viewRequests/viewUnAnsReq.html", data=data)
	    cursor.close()
	    conn.close()
	else:
		return redirect('/noAuth')

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
	if 'userID' in session:
	    query3 = "SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));"
	    cursor.execute(query3)
	    query = "SELECT transaction_id, service_name, transaction_status, CONCAT(firstname, ' ', lastname) AS 'name' FROM transaction t LEFT JOIN services s ON t.service_id = s.service_id LEFT JOIN user_details ON idUser = cust_id where transaction_status = 'ongoing' AND t.sp_id = '%s' GROUP BY transaction_id , service_name , name;" %session['userID']
	    cursor.execute(query)
	    chabal = cursor.fetchall()
	    
	    return render_template('transactions/editTrans.html', ako=chabal)
	    cursor.close()
	    conn.close()
	else:
		return redirect('/noAuth')

    
@app.route('/TransSuccess', methods = ['POST'])
def TransSuccess():
    
    idtran = request.form['babyrandall']
    query = "UPDATE transaction SET transaction_status='done' WHERE transaction_id='%s';" %idtran
    cursor.execute(query)

    conn.commit()
    return redirect('/editTrans')

    cursor.close()
    conn.close()	

@app.route('/showAnsTrans')
def showAnsTrans():
	if 'userID' in session:
	    query3 = "SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));"
	    cursor.execute(query3)
	    query = "SELECT transaction_id, service_name, transaction_status, CONCAT(firstname, ' ', lastname) AS 'name' FROM transaction t LEFT JOIN services s ON t.service_id = s.service_id LEFT JOIN user_details ON idUser = cust_id where transaction_status = 'done' AND t.sp_id = '%s' GROUP BY transaction_id , service_name , name;" %session['userID']
	    cursor.execute(query)
	    chabal = cursor.fetchall()
	    
	    return render_template('transactions/showAnsTrans.html', ako=chabal)
	    cursor.close()
	    conn.close()
	else:
		return redirect('/noAuth')
#==========================================================================

#======================VIEW PROFILE========================================
@app.route('/view')
def view():
	return render_template('dashboard.html')

@app.route('/viewprofile')
def viewprofile():

	if 'userID' in session:
		query = "SELECT firstName, middleName, lastName,address,email,contactNumber,company FROM user_details where idUser = '%s';" %session['userID']
		cursor.execute(query)	
		data = cursor.fetchall()
		conn.commit()

		query1 = "SELECT service_name, service_description, created_at from services where sp_id = '%s'" %session['userID']
		cursor.execute(query1)	
		data1 = cursor.fetchall()
		conn.commit()

		query3 = "SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));"
		cursor.execute(query3)
		query4 = "SELECT transaction_id, service_name, transaction_status, CONCAT(firstname, ' ', lastname) AS 'name' FROM transaction t LEFT JOIN services s ON t.service_id = s.service_id LEFT JOIN user_details ON idUser = cust_id where t.sp_id = '%s' GROUP BY transaction_id , service_name , name;" %session['userID']
		cursor.execute(query4)

		data2 = cursor.fetchall()
		conn.commit()

		return render_template('viewprofile.html', data=data,data1=data1,data2=data2)

		cursor.close()
		conn.close()
	else:
		return redirect('/noAuth')

#======================VIEW FEEDBACKS========================================
@app.route('/viewfeedbacks')
def viewfeedbacks():
	if 'userID' in session:
	    idsess = session['userID']
	    sql = "CREATE OR REPLACE VIEW theRes AS SELECT  idUser as a, content, CONCAT(lastName, firstName, middleName) AS resNames,feedback_date FROM feedback NATURAL JOIN user_details WHERE idUser = recepient AND idUser = '%s'; CREATE OR REPLACE VIEW theSender AS SELECT idUser as b, content, CONCAT(lastName, firstName, middleName) AS senderNames FROM feedback NATURAL JOIN user_details WHERE idUser = sender;" %idsess
	    cursor.execute(sql)
	    sql1 = "Select senderNames,theRes.content,feedback_date FROM theRes NATURAL JOIN theSender"
	    cursor.execute(sql1)
	    feedbacks = cursor.fetchall()
	    return render_template('viewFeedbacks.html', feedbacks=feedbacks)
	    cursor.close()
	    conn.close()
	else:
		return redirect('/noAuth')
#======================ADD SERVICE========================================

@app.route('/addservice')
def add():
	if 'userID' in session:
		return render_template('addServices.html')
	else:
		return redirect('/noAuth')

@app.route('/addservices', methods = ['POST'])
def addservice():
	
	serviceName = request.form['servicename']
	serviceDesc = request.form['servicedesc']

	errors = 0

	try:
		query = "INSERT INTO services (service_name, created_at, service_description, sp_id) VALUES ('%s', NOW(), '%s', '%s')" %(serviceName, serviceDesc,session['userID'])
		cursor.execute(query)

	except (MySQLdb.Error, MySQLdb.Warning):
		errors = errors +1
		return 'error on user input'

	if errors == 0:
		conn.commit()
		return redirect('/addservice')
	else:
		return "There was an error in requesting your acc"
	
	conn.close()
#======================DELETE SERVICE========================================
	
@app.route('/deleteservice')
def delete():
	if 'userID' in session:
		query = "SELECT service_name,service_description,created_at,service_id FROM services where sp_id = '%s';" %session['userID']
		cursor.execute(query)

		data = cursor.fetchall()
		return render_template('deleteServices.html', data = data)
	else:
		return redirect('/noAuth')

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
		return redirect('/deleteservice')
	else:
		return "There was an error"

	cursor.close();
	conn.close()	
    
    
if __name__ == '__main__':
	app.secret_key = 'ssssshhhhh'
	app.run(host='192.168.0.111', debug=True)