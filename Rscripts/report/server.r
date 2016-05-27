library(shiny)
library(DBI)
library(RMySQL)

mydb = dbConnect(MySQL(), user='desk', password='', dbname='ieproj', host='10.0.0.2')
data2 = dbGetQuery(mydb, "SELECT * FROM students;")

data_glob = NULL

# Define a server for the Shiny app
shinyServer(function(input, output,session) {
  
  # Filter data based on selections
  output$table <- DT::renderDataTable(DT::datatable({
    data <- data2
    if (input$country != "All") {
      data <- data[data$Current_Country == input$country,]
    }
    if (input$city != "All") {
      data <- data[data$City == input$city,]
    }
    if (input$highs != "All") {
      data <- data[data$Highschool == input$highs,]
    }
    if (input$sorttest) {
      data <- data[data$sorting_test == 1,]
    }
    if (input$mechina) {
      data <- data[data$Pass_mechina == 1,]
    }
    if (input$accepted) {
      data <- data[data$accepted == 1,]
    }
    data <- data[data$Year_Of_Birth >= input$yob[1] && data$Year_Of_Birth <= input$yob[2],]
    data <- data[data$Acceptance_Date >= input$date[1] && data$Acceptance_Date <= input$date[2],]
    data_glob <<- data
    data
  }, rownames = FALSE, colnames = c("ID", "Accep. Date", "Faculty", "Homeland", "Curr. Country", "City", "County", "Highschool", "Y.O.B", "Int. Bagrut", "Math 11", "Math 12", "Phys 11", "Phys 12", "Learn Dis.", "Eng. Test", "Eng. Test Grade","Eng. Test Type", "Sorting Test", "ST Math Grade", "ST Phys Grade", "ST Final Grade", "ST Type", "University", "Interview Grade", "Scholarship", "Accepted", "Passed Mechina", "Comments", "Pred. Result")
  ))
  output$downloadData <- downloadHandler(
    filename = function() { paste('output.csv', sep='') },
    content = function(file) {
      write.csv(data_glob, file)
    }
  )
})
dbDisconnect(mydb)

