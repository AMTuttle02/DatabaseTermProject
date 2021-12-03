import selenium
import mysql.connector as mysql
import pandas as pd
import time
from selenium.webdriver.remote.webelement import WebElement
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.action_chains import ActionChains
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.common.by import By
from selenium import webdriver

# user enters the desired timewindow 
window_begin = input("Enter earliest desried time for meeting:")
window_end = input("Enter latest desried time for meeting:")

#define delay time for browser interaction
delay = 0.5


# database instance for mySQL
db = mysql.connect(host = "localhost", user = "root", password= "", database = "dbmang")

# creating an instance of cursor used to execute SQL statements 
cursor = db.cursor()

# first search pass to grab classes with days that inlude Mon/Wed/Fri
try:

    # driver for Edge browser
    driver = webdriver.Edge(executable_path=r'C:\Selenium\msedgedriver')
    driver.get('https://my.uakron.edu/psp/prprodproxy/EMPLOYEE/CS/c/SA_LEARNER_SERVICES.SSS_STUDENT_CENTER.GBL?&cmd=uninav&Rnode=CS&uninavpath=Root{PORTAL_ROOT_OBJECT}.Students{UAP_STUD_ADMN}&PORTALPARAM_PTCNAV=UA_HE_STUDENT_CENTER&EOPP.SCNode=EMPL&EOPP.SCPortal=EMPLOYEE&EOPP.SCName=ADMN_MAX_SERVICES&EOPP.SCLabel=MAX%20Services&EOPP.SCPTcname=PT_PTPP_SCFNAV_BASEPAGE_SCR&FolderPath=PORTAL_ROOT_OBJECT.PORTAL_BASE_DATA.CO_NAVIGATION_COLLECTIONS.ADMN_MAX_SERVICES.ADMN_S201208171320528264798139&IsFolder=false') 
    driver.get('https://campus-ss.uakron.edu/psc/csprodss/EMPLOYEE/CS/c/SA_LEARNER_SERVICES.CLASS_SEARCH.GBL?Page=SSR_CLSRCH_ENTRY&Action=U&ExactKeys=Y#')
    w = WebDriverWait(driver, 10)
    
    #set to Term to "Spring 2022"
    dropDownTerm = w.until(EC.presence_of_element_located((By.XPATH, "//select[@name = 'CLASS_SRCH_WRK2_STRM$35$']")))
    dropDownTerm.click()
    action = ActionChains(driver)
    action.key_down(Keys.ARROW_DOWN).perform()
    action.key_down(Keys.ESCAPE).perform()
    
    #wait to make sure webpage is ready for next action
    time.sleep(delay)

    #set Location to "Akron Campus"
    dropDownLoc = w.until(EC.presence_of_element_located((By.XPATH, "//select[@name = 'SSR_CLSRCH_WRK_LOCATION$5']")))
    dropDownLoc.click()
    action.key_down(Keys.ARROW_DOWN).perform()
    action.key_down(Keys.ESCAPE).perform()

    #wait to make sure webpage is ready for next action
    time.sleep(delay)

    #set Mode of Instruction to "In Person"
    dropDownLoc = w.until(EC.presence_of_element_located((By.XPATH, "//select[@name = 'SSR_CLSRCH_WRK_INSTRUCTION_MODE$8']")))
    dropDownLoc.click()
    action.send_keys('I')
    action.key_down(Keys.ESCAPE).perform()

    #wait to make sure webpage is ready for next action
    time.sleep(delay)

    #set Meeting Start Time to "between"
    dropDownMT = w.until(EC.element_to_be_clickable((By.XPATH, "//select[@name = 'SSR_CLSRCH_WRK_SSR_START_TIME_OPR$10']")))
    dropDownMT.click()
    action.key_down(Keys.ARROW_UP).perform()
    action.key_down(Keys.ARROW_UP).perform()
    action.key_down(Keys.ESCAPE).perform()

    #wait to make sure webpage is ready for next action
    time.sleep(delay)

    #set earliest Meeting Start Time criteria
    searchBarMTB = w.until(EC.presence_of_element_located((By.XPATH, "//input[@name = 'SSR_CLSRCH_WRK_MEETING_TIME_START$10']")))
    searchBarMTB.click()
    action.send_keys(window_begin)
    action.key_down(Keys.ESCAPE).perform()

    #wait to make sure webpage is ready for next action
    time.sleep(delay)

    #set latest Meeting Start Time criteria
    searchBarMTE = w.until(EC.presence_of_element_located((By.XPATH, "//input[@name = 'SSR_CLSRCH_WRK_SSR_MTGTIME_START2$10']")))
    searchBarMTE.click()
    action.send_keys(window_end)
    action.key_down(Keys.ESCAPE).perform()

    #wait to make sure webpage is ready for next action
    time.sleep(delay)

    #set dropdown for "exlude any of these days"
    dropDownExcludeDay = w.until(EC.presence_of_element_located((By.XPATH, "//select[@name = 'SSR_CLSRCH_WRK_INCLUDE_CLASS_DAYS$11']")))
    dropDownExcludeDay.click()
    action.send_keys('E')
    action.key_down(Keys.ESCAPE).perform()

    #wait to make sure webpage is ready for next action
    time.sleep(delay)

    #click checkboxes for Tues, Thurs, Sat, Sun
    checkboxTues = w.until(EC.presence_of_element_located((By.XPATH, "//input[@name = 'SSR_CLSRCH_WRK_TUES$11']")))
    checkboxTues.click()
    time.sleep(delay)
    checkboxThurs = w.until(EC.presence_of_element_located((By.XPATH, "//input[@name = 'SSR_CLSRCH_WRK_THURS$11']")))
    checkboxThurs.click()
    time.sleep(delay)
    checkboxSat = w.until(EC.presence_of_element_located((By.XPATH, "//input[@name = 'SSR_CLSRCH_WRK_SAT$11']")))
    checkboxSat.click()
    time.sleep(delay)
    checkboxSun = w.until(EC.presence_of_element_located((By.XPATH, "//input[@name = 'SSR_CLSRCH_WRK_SUN$11']")))
    checkboxSun.click()
    action.key_down(Keys.ENTER).perform()


    print("Search criteria was entered sucessfully!")
#if at any point, an xpath cannot be found, timeout
except TimeoutException:
    print("Search page could not be opened, timeout has occured...")

#define base strings for first entries in the table 
classNumXpath = "//a[@name = 'MTG_CLASS_NBR$0']"
dayTimeXpath = "//span[@id = 'MTG_DAYTIME$0']"
roomXpath = "//span[@id = 'MTG_ROOM$0']"


#check to make sure search page actually opened by looking at first element 
try:
    firstElementFound = w.until(EC.presence_of_element_located((By.XPATH, classNumXpath)))
except TimeoutException:
    print("Search page was not openned sucessfully.")
    driver.quit()
    quit()


oldSubstr = "$0"
try:
    for i in range(0,199):
        newSubStr = "$" + str(i)
        
        # iterate through each element in the table row by row 
        classNumXpath = classNumXpath.replace(oldSubstr, newSubStr)
        dayTimeXpath = dayTimeXpath.replace(oldSubstr, newSubStr)
        roomXpath = roomXpath.replace(oldSubstr, newSubStr)
    

        # capture the plaintext from html elements as strings
        classNumStr = str(w.until(EC.presence_of_element_located((By.XPATH, classNumXpath))).text)
        dayTimeStr = str(w.until(EC.presence_of_element_located((By.XPATH, dayTimeXpath))).text)
        roomStr = str(w.until(EC.presence_of_element_located((By.XPATH, roomXpath))).text)

        # dayTimeStr needs to be parsed into Start Time, End Time, and a boolean for each day 
        # first split the days froms the time
        startTimeStr = "00:00"
        endTimeStr = "00:00"
        
        #set day booleans
        mon = 0
        tues = 0
        wed = 0
        thurs = 0 
        fri = 0
        try:
            if dayTimeStr.index("MoWeFr ") == 0:
                mon = 1
                wed = 1
                fri = 1
        except ValueError:
            pass
        try:
            if dayTimeStr.index("MoWe ") == 0:
                    mon = 1
                    wed = 1
        except ValueError:
            pass
        try:
            if dayTimeStr.index("Mo ") == 0:
                mon = 1
        except ValueError:
            pass
        try:
            if dayTimeStr.index("We ") == 0:
                wed = 1
        except ValueError:
            pass
        try:
            if dayTimeStr.index("Fr ") == 0:
                fri = 1
        except ValueError:
            pass
        try:
            if dayTimeStr.index("MoFr ") == 0:
                mon = 1
                fri = 1
        except ValueError:
            pass
        try:
            if dayTimeStr.index("WeFr ") == 0:
                wed = 1
                fri = 1
        except ValueError:
            pass

        modDayTime = dayTimeStr.split(' ')
        startTimeStr = modDayTime[1]
        endTimeStr = modDayTime[3]
        if "AM" in startTimeStr:
            modStart = startTimeStr.split('A')
            startTimeStr = modStart[0]
        elif "PM" in startTimeStr:
            modStart = startTimeStr.split('PM')
            startTimeStr = modStart[0]
            modTemp = startTimeStr.split(':')
            tempStr = modTemp[0]
            tempInt = int(tempStr) + 12
            startTimeStr = str(tempInt) + ":" + modTemp[1]

        if "AM" in endTimeStr:
            modEnd = endTimeStr.split('A')
            endTimeStr = modEnd[0]
        elif "PM" in endTimeStr:
            modEnd = endTimeStr.split('PM')
            endTimeStr = modEnd[0]
            modTemp = endTimeStr.split(':')
            tempStr = modTemp[0]
            tempInt = int(tempStr) + 12
            endTimeStr = str(tempInt) + ":" + modTemp[1]
       
        # create parameters to be based into SQL query
        addcourseinfo = ("INSERT INTO courseinfo " "VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)")
        datacourseinfo = (classNumStr, startTimeStr, endTimeStr, roomStr, mon, tues, wed, thurs, fri)
        
        # try to run SQL query, if it fails catch the exception, print error info, and move on
        try:
            cursor.execute(addcourseinfo, datacourseinfo)
        except mysql.Error as err:
            print(err)
            print("Error Code: ", err.errno)
            print("SQL STATE: ", err.sqlstate)
            print("Message: ", err.msg)

        if i != 0:
            oldSubstr = "$" + str(i)
            
except TimeoutException:
    print("End of search results")

driver.quit()  

# execute search again for classes that inlude Tues/Thurs
try:
    driver = webdriver.Edge(executable_path=r'C:\Selenium\msedgedriver')
    driver.get('https://my.uakron.edu/psp/prprodproxy/EMPLOYEE/CS/c/SA_LEARNER_SERVICES.SSS_STUDENT_CENTER.GBL?&cmd=uninav&Rnode=CS&uninavpath=Root{PORTAL_ROOT_OBJECT}.Students{UAP_STUD_ADMN}&PORTALPARAM_PTCNAV=UA_HE_STUDENT_CENTER&EOPP.SCNode=EMPL&EOPP.SCPortal=EMPLOYEE&EOPP.SCName=ADMN_MAX_SERVICES&EOPP.SCLabel=MAX%20Services&EOPP.SCPTcname=PT_PTPP_SCFNAV_BASEPAGE_SCR&FolderPath=PORTAL_ROOT_OBJECT.PORTAL_BASE_DATA.CO_NAVIGATION_COLLECTIONS.ADMN_MAX_SERVICES.ADMN_S201208171320528264798139&IsFolder=false') 
    driver.get('https://campus-ss.uakron.edu/psc/csprodss/EMPLOYEE/CS/c/SA_LEARNER_SERVICES.CLASS_SEARCH.GBL?Page=SSR_CLSRCH_ENTRY&Action=U&ExactKeys=Y#')
    w = WebDriverWait(driver, 10)

    #set to Term to "Spring 2022"
    dropDownTerm = w.until(EC.presence_of_element_located((By.XPATH, "//select[@name = 'CLASS_SRCH_WRK2_STRM$35$']")))
    dropDownTerm.click()
    action = ActionChains(driver)
    action.key_down(Keys.ARROW_DOWN).perform()
    action.key_down(Keys.ESCAPE).perform()
    
    #wait to make sure webpage is ready for next action
    time.sleep(delay)

    #set Location to "Akron Campus"
    dropDownLoc = w.until(EC.presence_of_element_located((By.XPATH, "//select[@name = 'SSR_CLSRCH_WRK_LOCATION$5']")))
    dropDownLoc.click()
    action.key_down(Keys.ARROW_DOWN).perform()
    action.key_down(Keys.ESCAPE).perform()

    #wait to make sure webpage is ready for next action
    time.sleep(delay)

    #set Mode of Instruction to "In Person"
    dropDownLoc = w.until(EC.presence_of_element_located((By.XPATH, "//select[@name = 'SSR_CLSRCH_WRK_INSTRUCTION_MODE$8']")))
    dropDownLoc.click()
    action.send_keys('I')
    action.key_down(Keys.ESCAPE).perform()

    #wait to make sure webpage is ready for next action
    time.sleep(delay)

    #set Meeting Start Time to "between"
    dropDownMT = w.until(EC.element_to_be_clickable((By.XPATH, "//select[@name = 'SSR_CLSRCH_WRK_SSR_START_TIME_OPR$10']")))
    dropDownMT.click()
    action.key_down(Keys.ARROW_UP).perform()
    action.key_down(Keys.ARROW_UP).perform()
    action.key_down(Keys.ESCAPE).perform()

    #wait to make sure webpage is ready for next action
    time.sleep(delay)

    #set earliest Meeting Start Time criteria
    searchBarMTB = w.until(EC.presence_of_element_located((By.XPATH, "//input[@name = 'SSR_CLSRCH_WRK_MEETING_TIME_START$10']")))
    searchBarMTB.click()
    action.send_keys(window_begin)
    action.key_down(Keys.ESCAPE).perform()

    #wait to make sure webpage is ready for next action
    time.sleep(delay)

    #set latest Meeting Start Time criteria
    searchBarMTE = w.until(EC.presence_of_element_located((By.XPATH, "//input[@name = 'SSR_CLSRCH_WRK_SSR_MTGTIME_START2$10']")))
    searchBarMTE.click()
    action.send_keys(window_end)
    action.key_down(Keys.ESCAPE).perform()

    #wait to make sure webpage is ready for next action
    time.sleep(delay)

    #set dropdown for "exlude any of these days"
    dropDownExcludeDay = w.until(EC.presence_of_element_located((By.XPATH, "//select[@name = 'SSR_CLSRCH_WRK_INCLUDE_CLASS_DAYS$11']")))
    dropDownExcludeDay.click()
    action.send_keys('E')
    action.key_down(Keys.ESCAPE).perform()

    #wait to make sure webpage is ready for next action
    time.sleep(delay)

    #Click checkboxes for Mon/Wed/Fri & Sat/Sun
    checkboxMon = w.until(EC.presence_of_element_located((By.XPATH, "//input[@name = 'SSR_CLSRCH_WRK_MON$11']")))
    checkboxMon.click()
    time.sleep(delay)
    checkboxWed = w.until(EC.presence_of_element_located((By.XPATH, "//input[@name = 'SSR_CLSRCH_WRK_WED$11']")))
    checkboxWed.click()
    time.sleep(delay)
    checkboxFri = w.until(EC.presence_of_element_located((By.XPATH, "//input[@name = 'SSR_CLSRCH_WRK_FRI$11']")))
    checkboxFri.click()
    time.sleep(delay)
    checkboxSat = w.until(EC.presence_of_element_located((By.XPATH, "//input[@name = 'SSR_CLSRCH_WRK_SAT$11']")))
    checkboxSat.click()
    time.sleep(delay)
    checkboxSun = w.until(EC.presence_of_element_located((By.XPATH, "//input[@name = 'SSR_CLSRCH_WRK_SUN$11']")))
    checkboxSun.click()
    action.key_down(Keys.ENTER).perform()

    print("Search criteria was entered sucessfully!")
    
except TimeoutException:
    print("Search page was not openned sucessfully.")


#reset the Xpaths to point to first entries in table
classNumXpath = "//a[@name = 'MTG_CLASS_NBR$0']"
dayTimeXpath = "//span[@id = 'MTG_DAYTIME$0']"
roomXpath = "//span[@id = 'MTG_ROOM$0']"

#check to make sure search page actually opened by looking at first element 
try:
    firstElementFound = w.until(EC.presence_of_element_located((By.XPATH, classNumXpath)))
except TimeoutException:
    print("Search page was not openned sucessfully.")
    driver.quit()
    quit()

# grab the information from the modified search       
oldSubstr = "$0"
try:
    for i in range(0,199):
        newSubStr = "$" + str(i)
        
        #iterate through each element in the table row by row 
        classNumXpath = classNumXpath.replace(oldSubstr, newSubStr)
        dayTimeXpath = dayTimeXpath.replace(oldSubstr, newSubStr)
        roomXpath = roomXpath.replace(oldSubstr, newSubStr)

        # capture the plaintext from html elements as strings
        classNumStr = str(w.until(EC.presence_of_element_located((By.XPATH, classNumXpath))).text)
        dayTimeStr = str(w.until(EC.presence_of_element_located((By.XPATH, dayTimeXpath))).text)
        roomStr = str(w.until(EC.presence_of_element_located((By.XPATH, roomXpath))).text)

        # dayTimeStr needs to be parsed into Start Time, End Time, and a boolean for each day 
        # first split the days froms the time
        startTimeStr = "00:00"
        endTimeStr = "00:00"
        
        #set day booleans
        mon = 0
        tues = 0
        wed = 0
        thurs = 0 
        fri = 0
        try:
            if dayTimeStr.index("TuTh ") == 0:
                tues = 1
                thurs = 1
        except ValueError:
            pass
        try:
            if dayTimeStr.index("Tu") == 0:
                tues =1
        except ValueError:
            pass
        try:
            if dayTimeStr.index("Th ") == 0:
                thurs = 1
        except ValueError:
            pass

        modDayTime = dayTimeStr.split(' ')
        startTimeStr = modDayTime[1]
        endTimeStr = modDayTime[3]
        if "AM" in startTimeStr:
            modStart = startTimeStr.split('A')
            startTimeStr = modStart[0]
        elif "PM" in startTimeStr:
            modStart = startTimeStr.split('PM')
            startTimeStr = modStart[0]
            modTemp = startTimeStr.split(':')
            tempStr = modTemp[0]
            tempInt = int(tempStr) + 12
            startTimeStr = str(tempInt) + ":" + modTemp[1]
        if "AM" in endTimeStr:
            modEnd = endTimeStr.split('A')
            endTimeStr = modEnd[0]
        elif "PM" in endTimeStr:
            modEnd = endTimeStr.split('PM')
            endTimeStr = modEnd[0]
            modTemp = endTimeStr.split(':')
            tempStr = modTemp[0]
            tempInt = int(tempStr) + 12
            endTimeStr = str(tempInt) + ":" + modTemp[1]
       
        # create parameters to be based into SQL query
        addcourseinfo = ("INSERT INTO courseinfo " "VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)")
        datacourseinfo = (classNumStr, startTimeStr, endTimeStr, roomStr, mon, tues, wed, thurs, fri)
        
        # try to run SQL query, if it fails catch the exception, print error info, and move on
        try:
            cursor.execute(addcourseinfo, datacourseinfo)
        except mysql.Error as err:
            print(err)
            print("Error Code: ", err.errno)
            print("SQL STATE: ", err.sqlstate)
            print("Message: ", err.msg)

        if i != 0:
            oldSubstr = "$" + str(i)
            
except TimeoutException:
    print("End of search results")

driver.quit()   
