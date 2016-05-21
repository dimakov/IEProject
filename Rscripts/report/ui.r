library(shiny)
library(DBI)
library(RMySQL)

mydb = dbConnect(MySQL(), user='root', password='', dbname='ieproj', host='10.0.0.1')
data = dbGetQuery(mydb, "SELECT * FROM students;")

#for (i in 1:nrow(data2))
#{
#  if (data2[i,]$GradStud == 4)
#  {
#    sqlStatement <- paste("UPDATE students SET GradStud = 6 WHERE ID = ",data2[i,]$ID,";" ,sep="")
#    dbGetQuery(mydb, sqlStatement)
#  }
#}

dbDisconnect(mydb)

# Define the overall UI
shinyUI(
  fluidPage(
    titlePanel("All Students"),
    # Create a new Row in the UI for selectInputs
    fluidRow(
      column(2,
             selectInput("country",
                         "Current country:",
                         c("All",
                           unique(as.character(data$Current_Country))))
      ),
      column(1,
             selectInput("city",
                         "City:",
                         c("All",
                           unique(as.character(data$City))))
      ),
      column(1,
             selectInput("highs",
                         "Highschool:",
                         c("All",
                           unique(as.character(data$Highschool))))
      ),
      column(2,
             sliderInput("yob","Year Of Birth", min = 1970, 
                         max = 2025, value = c(1995, 2015), sep = "")
      ),
      column(2,
             dateRangeInput("date",
                            label = paste('Date range:'),
                            start = "2001-01-01", 
                            end = "2030-01-01",
                            separator = " - ", format = "yyyy/mm/dd",
                            startview = 'year', language = 'he', weekstart = 1
             )
      ),
      column(1,
             checkboxInput("sorttest", label = "Sorting test", value = FALSE),
             checkboxInput("mechina", label = "Passed mechina", value = FALSE)
      ),
      column(1,
             checkboxInput("accepted", label = "Accepted", value = FALSE)
      )
    ),
    # Create a new row for the table.
    fluidRow(
      DT::dataTableOutput("table")
    ),
    downloadButton('downloadData', 'Export to CSV'),
    br(),
    fluidRow(
      column(1,
             htmlOutput("rpartres")
      )
    )
  )
)

