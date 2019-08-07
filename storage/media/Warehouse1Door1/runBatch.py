# -*- coding: utf-8 -*-
"""
Created on Fri Aug  2 19:08:34 2019

@author: ripal
"""

import glob
import os
import csv
import time
import pymysql
global videoName
fileList = glob.glob("*.info")
if fileList:
    for trueFile in fileList:
        #print(fileList)
        videoName=trueFile
        #print(type(videoName))
        videoName = videoName[:-5]
        #print(videoName)
        
        mydb = pymysql.connect(host='localhost',#change IP address
			user='root',
			passwd='georgea',
			db='instavideo2')
        cursor = mydb.cursor()

        #csv_data = csv.reader(open(videoName+'.info'),delimiter='|')
        #for row in csv_data:
           # cursor.execute('INSERT INTO vibe_videos(ispremium,media,token,pub,user_id,date,featured,private,source,tmp_source,title,thumb,duration,description,tags,category,views,liked,disliked,nsfw,embed,remote,srt,privacy,location,load_num,item,comment,start_date_time,end_date_time) VALUES( %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s, %s, %s, %s, %s, %s,%s,%s)', row)
        with open(videoName+'.info','rt') as f:
            csv_data = csv.reader(f,delimiter='|')
            for row in csv_data:
                cursor.execute('INSERT INTO vibe_videos(ispremium,media,token,pub,user_id,date,featured,private,source,tmp_source,title,thumb,duration,description,tags,category,views,liked,disliked,nsfw,embed,remote,srt,privacy,location,load_num,item,comment,start_date_time,end_date_time,warehouse,door) VALUES( %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s, %s, %s, %s, %s, %s,%s,%s,%s,%s)', row)
               
        getLocation = "SELECT  id,location  FROM vibe_videos WHERE title = '"+videoName+".mp4' "
        #print(getLocation)
        cursor.execute(getLocation)
        location = cursor.fetchall()
        #print(location[0][1])
        if location:
            query = "insert into vibe_playlist_data(playlist,video_id)  select b.id,a.id from vibe_videos a INNER JOIN vibe_playlists b on a.location collate utf8_general_ci = b.title collate utf8_general_ci where a.title='"+videoName+".mp4' and b.title='"+location[0][1]+"'"
		#print(query)
            cursor.execute(query)
        else:
                insertLocationQuery ="insert into vibe_playlists(ptype,owner,title,type) values(1,1,'"+location[0][1]+"',1) "
                query = "insert into vibe_playlist_data(playlist,video_id)  select b.id,a.id from vibe_videos a INNER JOIN vibe_playlists b on a.location collate utf8_general_ci = b.title collate utf8_general_ci where a.title='"+videoName+".mp4' and b.title='"+location[0][1]+"'"
                #print(query)
                cursor.execute(query)
        getDate = "SELECT  DATE_FORMAT(date,'%Y-%m-%d'),id,location  FROM vibe_videos WHERE title = '"+videoName+".mp4' limit 1 "
        print(getDate)
        cursor.execute(getDate)
        data = cursor.fetchall()
        dated = data[0][0]
        print(data)
        print(dated)
        checkDateQuery="select id from vibe_playlists where title='"+data[0][0]+"'"
        print(checkDateQuery)
        cursor.execute(checkDateQuery)
        checkedDate = cursor.fetchall()
        if checkedDate:
            print(checkedDate)
            insertDateVideoQuery = "insert into vibe_playlist_data(playlist,video_id)  select b.id,a.id from vibe_videos a INNER JOIN vibe_playlists b on a.date  = b.title where a.title= '"+videoName+".mp4' and b.title=(select a.date from vibe_videos a where  a.title= '"+videoName+".mp4')"
            cursor.execute(insertDateVideoQuery)		
        else:
            print('no data')
            insertDatequery = "insert into vibe_playlists(ptype,owner,title,type) values(1,1,'"+dated+"',2)"
            cursor.execute(insertDatequery)
            insertDateVideoQuery = "insert into vibe_playlist_data(playlist,video_id)  select b.id,a.id from vibe_videos a INNER JOIN vibe_playlists b on a.date  = b.title where a.title= '"+videoName+".mp4' and b.title=(select a.date from vibe_videos a where  a.title= '"+videoName+".mp4')"
            cursor.execute(insertDateVideoQuery)
        print("data insertion completed")
        date = time.strftime("%Y-%m-%d")
        mydb.commit()
        cursor.close()
		
		
        videoList=glob.glob(videoName+"_*.mp4")
        videoList.sort(key=os.path.getmtime)
        text_file = open("Output.txt", "w")
        if videoList:
            for vdFile in videoList:
                print(vdFile)
                text_file.write("file '%s'\n" % vdFile)
            text_file.close()

        concatVideo='ffmpeg -y -f concat -safe 0 -i C:\\xampp\\htdocs\\videogallery\\storage\\media\\Warehouse1Door1\\Output.txt -c copy '+videoName+'.mp4'
		
        os.system(concatVideo)
		
        deletedInfoFile="del "+videoName+".info"
        deleteVideoChunks="del "+videoName+"_*.mp4"

        os.system(deletedInfoFile)
        os.system(deleteVideoChunks)
                       
                       