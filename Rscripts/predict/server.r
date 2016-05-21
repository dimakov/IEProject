library(shiny)
library(DBI)
library(RMySQL)
library(MASS)

# Define a server for the Shiny app
shinyServer(function(input, output,session) {
  
  mydb = dbConnect(MySQL(), user='desk', password='', dbname='ieproj', host='10.0.0.1')
  data_ = dbGetQuery(mydb, "SELECT * FROM students;")
  pred_glob = NULL
  
  data_ <- data_[which(data_$accepted==1 | data_$accepted==0),]
  
  impute.med <- function(x) {
    z <- median(x, na.rm = TRUE)
    x[is.na(x)] <- z
    return(x)
  }
  
  for (i in c(9:17, 19:22, 24:26)) {
    to_delete <- c()
    if (length(data_[,i][is.na(data_[,i])])/length(data_[,i]) < 0.2){
      data_[,i] <- impute.med(data_[,i])}
    else {to_delete = c(to_delete, i)}
  }
  
  data_[,to_delete] <- NULL
  
  df = data_[,c(9:16,23:26,28)]
  df<-na.omit(df)
  
  lda_model<-lda(df$Pass_mechina~.,data=df)
  
  for (i in 1:nrow(data_))
  {
    if (is.na(data_[i,]$prediction_res))
    {
      temp_=data_[i,c(9:16,23:26,28)]
      prediction = predict(lda_model, temp_)$posterior[,"1"]
      prediction = format(round(prediction, 3), nsmall = 3)
      pred_glob = prediction
      sqlStatement <- paste("UPDATE students SET prediction_res = ",prediction," WHERE ID = ",data_[i,]$ID,";" ,sep="")
      dbSendQuery(mydb, sqlStatement)
    }
  }
  dbDisconnect(mydb)
    output$text1 <- renderText({
      paste("Pridiction of the algorithm is: ", pred_glob, sep="")
    })
})

