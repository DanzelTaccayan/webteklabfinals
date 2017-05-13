from flask import Flask, render_template, request, redirect
from flask_mysqldb import MySQLdb
from werkzeug.security import generate_password_hash, check_password_hash


app = Flask(__name__)

conn = MySQLdb.connect("localhost","root","","initialdb")
cursor = conn.cursor()
cursor1 = conn.cursor()

@app.route('/')
def index():
	return render_template('dashboard.html')

@app.route('/edit')
def add():
    query = "SELECT transaction_id, service_name, transaction_status, CONCAT(firstname, ' ', lastname) AS 'name' FROM transaction t LEFT JOIN services s ON t.service_id = s.service_id LEFT JOIN user_details ON idUser = sp_id GROUP BY transaction_id , service_name , name;"
    cursor.execute(query)
    chabal = cursor.fetchall()
    
    return render_template('index.html', ako=chabal)
    conn.close()

@app.route('/trial')
def trial():
    query = "SELECT transaction_id, service_name, transaction_status, CONCAT(firstname, ' ', lastname) AS 'name' FROM transaction t LEFT JOIN services s ON t.service_id = s.service_id LEFT JOIN user_details ON idUser = sp_id GROUP BY transaction_id , service_name , name;"
    cursor.execute(query)
    chabal = cursor.fetchall()
    
    return render_template('edit.html', ako=chabal)
    conn.close()
    
@app.route('/success', methods = ['POST'])
def successful():
    
    idtran = request.form['babyrandall']
    query = "UPDATE transaction SET transaction_status='done' WHERE transaction_id='%s';" %idtran
    cursor.execute(query)
    
    return redirect('/edit')
    
    conn.commit()
    cursor.close()
    conn.close()	
    
@app.route('/signUp')
def signUp():
	return render_template('signUp.html')

@app.route('/manage')
def manage():
	return render_template('login.html')

#@app.route('/manageReq',methods = ['POST'])
#def manageReq():
#	try:
#		query = "SELECT * FROM request VALUES ('%i', '%s', NOW())" %(service_id, serivce_name, created_at)
#		cursor.execute(query)
#        return 'yot'
#
#	except (MySQLdb.Error, MySQLdb.Warning):
#		errors = errors +1
#		return 'error'    

@app.route('/accept')
def accept():
	return render_template('accepted.html')

@app.route('/reject')
def reject():
	return render_template('rejected.html')

@app.route('/success',methods =	['POST'])
def success():
	firstName = request.form['fname']
	middleName = request.form['mname']
	lastName = request.form['lname']
	address = request.form['address']
	email = request.form['email']
	contactNum = request.form['contactnumber']
	company = request.form['company']


	uname = request.form['uname']
	userPass = request.form['pass']

	userPassHash = generate_password_hash(userPass)
	errors = 0

	try:
		query = "INSERT INTO users (UserName, Password, Status) VALUES ('%s', '%s', 'pending')" %(uname, userPassHash)
		cursor.execute(query)
	
		userId = conn.insert_id()

	except (MySQLdb.Error, MySQLdb.Warning):
		errors = errors +1
		return 'error on user input'

	if errors == 0:
		try:
			query2 = "INSERT INTO user_details (idUser, firstName, middleName, lastName, address, email, contactNumber, company, created_at, updated_at, UserType) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', NOW(), NOW(), 'SP')" %(userId, firstName, middleName, lastName, address, email,contactNum, company )
			cursor.execute(query2)
		except (MySQLdb.Error, MySQLdb.Warning):
			errors = errors + 1


	if errors == 0:
		conn.commit()
		return "Yeah"
	else:
		return "There was an error in requesting your acc"
	
	conn.close()



if __name__ == '__main__':
	app.run(host='localhost', debug=True)
