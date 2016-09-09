<style>
    body {
        background-color: #f2f2f2;
        font-family:Candara, Arial, sans-serif;
    }
    
    div#all_wrap {
        background-color:#f2f2f2;
        width:95%;
        margin-left:auto;
        margin-right:auto;
        margin-top:30px;
        padding:15px;
        border:3px solid #d1d1e0;
        overflow:auto;
    }
    
/*NAVIGATION*/    
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #b3b3ff;
        border: 0px solid #000000;
    }

    li {
        float: left;
        border-right: 5px solid #d1d1e0;
    }
        
    li:last-child {
    }

    li a {
        display: block;
        color: #3399ff;
        text-align: center;
        padding-top: 15px;
        padding-bottom: 5px;
        padding-right: 5px;
        padding-left: 20px;
        background-color: #e6f2ff;
        text-decoration: none;
        font-size:1.1em;
        font-family:Candara, Arial, sans-serif;
        font-weight: bold;
    }

    li a:hover:not(.active) {
        background-color: #3399ff;
        color: white;
    }
        
    .active {
        background-color: #5c00e6;
        color: white;
    }
    
    div#main_wrap {
        background-color:#f2f2f2;
        min-height:395px;
    }
        
    section#add_link_form {
        width:260px;
        float:left;
        background-color:#b3b3ff;
        border:0px solid black;
        padding:0px;
    }
    
    .left_column {
        width:130px;
        float:left;
    }
    
    .right_column {
        width:130px;
        float:left;
    }
    
/*CHECKBOX CODE - FROM STACKOVERFLOW*/
    input[type="checkbox"] {
        display: none;
    }
    label {
        cursor: pointer;
    }
    input[type="checkbox"] + label:before {
        border: 1px solid #7f83a2;
        content: "\00a0";
        display: inline-block;
        font: 16px/1em sans-serif;
        height: 16px;
        margin: 0 .25em 0 0;
        padding: 0;
        vertical-align: top;
        width: 16px;
    }
    input[type="checkbox"]:checked + label:before {
        background: #3d404e;
        color: #666;
        content: "\2713";
        text-align: center;
    }
    input[type="checkbox"]:checked + label:after {
        font-weight: bold;
    }     
    
    section.top-line {
        overflow:hidden;
        padding-top:5px;
        margin-bottom:5px;
    }

    div.top-line-content {
        width:99%;
        margin-left:auto;
     
    }
/*LINK OUTPUT TABLE*/
    section#results_table {
        overflow:hidden;
    }
    
    table#link_output {
        table-layout:fixed;
        border-collapse:collapse;
        border-bottom:3px solid #5c00e6;
        border-left:1px solid #5c00e6;
        border-right:1px solid #5c00e6;
        width:99%;
        margin-left:auto;

    }
    
    table#link_output tr, th, td {
        overflow:hidden;
        white-space:nowrap;
        text-overflow:ellipsis;
        border-right:1px solid #5c00e6;
        padding-left:5px;
        padding-right:5px; 
        padding-top:3px;
        padding-bottom:2px;
    }

    table#link_output th {
        background-color:#5c00e6;
        color:#ffffff;
    }
    
    table#link_output th.title {
        width:175px;
    }
    
    table#link_output th.tags {
        width:225px;
    }
    
    table#link_output th.notes {
        width:350px;
    }
    
    table#link_output th.delete {
        width:40px;
    }
   
    table#link_output tr:nth-child(even) {
        background-color:#e6f2ff;
    }
    
    table#link_output tr:nth-child(odd) {
        background-color:#b3d7ff;
    }
    
    table#link_output tr:hover {
        background-color:#b3b3ff;
    }
    
    table#link_output td:hover {
        white-space:normal;
    }
    
    a.bookmark {
        font-size:1.05em;
        text-decoration:none;
        display:block;
        font-family:Candara, Arial, sans-serif;
    }
    
    a.bookmark:hover {
        font-size:1.05em;
        font-weight:bold;
    }
    
</style> 