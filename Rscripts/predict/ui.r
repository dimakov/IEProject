library(shiny)
library(DBI)
library(RMySQL)
library(MASS)

# Define the overall UI
shinyUI(
  fluidPage(
    verbatimTextOutput("text1"),
    tags$head(tags$style("#text1{color: blue; position:center;
                                 font-size: 28px;
                         font-family:Arial;
                         }"
                         )
    )
  )
)

