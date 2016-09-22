<style>
    @font-face {
        font-family:AlexBrush;
        src:url(http://localhost/internet-research/fonts/AlexBrush.ttf)
    }
    
    body {
        background-color: #eaeff2;
        font-family: Candara, Arial, sans-serif;
        /* Open Sans Light */
    }
    
    div#all_wrap {
        background-color:#f5f5f5;
        width:95%;
        margin-left:auto;
        margin-right:auto;
        margin-top:30px;
        padding:15px;
        border:3px solid #d1d1e0;
        overflow:auto;
    }
    
/*NAVIGATION*/    
    ul#navbar {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #b3b3ff;
    }

    li.navbutton {
        float: left;
        border-right: 5px solid #4d4e53;
    }
        
    li:last-child.navbutton {
    }

    li a.navlink {
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
    
    li a.active {
        background-color: #5c00e6;
        color: white;
    }
    
    section#side-panel {
        float:left;
        min-height:395px;
    }
        
    div#add-link-form {
        width:320px;
        background-color:#b3b3ff;
        border:2px solid #4d4e53;
        padding:5px;
        margin-top:7px;
    }
    
    div#filter-by-tag {
        overflow:auto;
        width:320px;
        background-color:#e6f2ff;
        border:2px solid #4d4e53;
        border-top:0px solid #C8D2DE;
        padding:5px;
        margin-top:0px;
    }
    
    input.titleurl {
        border:2px solid #4d4e53;
        width:316px;
        height:20px;
        margin-bottom:7px;
        
    }
    
    .left_column {
        width:160px;
        float:left;
    }
    
    .right_column {
        width:160px;
        float:left;
    }
    
/*CHECKBOX CODE - FROM STACKOVERFLOW*/
    input[type="checkbox"].taglist {
        display: none;
    }
    label {
        cursor: pointer;
    }
    input[type="checkbox"].taglist + label:before {
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
    input[type="checkbox"]:checked.taglist + label:before {
        background: #3d404e;
        color: #666;
        content: "\2713";
        text-align: center;
    }
    input[type="checkbox"]:checked.taglist + label:after {
        font-weight: bold;
    }     
    
    section#top-line {
        overflow:hidden;
        padding-top:5px;
        margin-bottom:15px;
    }

    div#top-line-content {
        width:99%;
        margin-left:auto;
    }
    
/*FILTER TAGS*/
    li.filter-tags {
        display:block;
        float:left;
        margin-right:10px;
    }
    
    input.filter-tag-checkbox {
        margin-right:1px;
    }
    
    label.filter-tag-label {
        color:#636363;
        text-transform:uppercase;
        font-size:.75em;
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
        margin-top:7px;

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
    
    td.align-left {
        text-align:left;
    }
    
    table#link_output th.notes {
        width:350px;
    }
    
    span.tagDisplay {
        font-size:.8em;
        font-weight:bold;
        text-overflow:clip;
        color:#4d4e53;
        background-color:#F2F8FF;
        border:1px solid #95969C;
        border-radius:25px;
        padding-left:7px;
        padding-right:7px;
        margin-right:7px;
        opacity:1;
    }
    
    table#link_output th.delete {
        width:8px;
    }
   
    input[type="submit"].delete-x {
        padding:0px;
        margin:0px;
        border:2px solid #FAA850;
        background-color:#FFD3A3;
        height:16px;
        width:16px;
        cursor:pointer;
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
        font-size:.9em;
        text-decoration:none;
        display:block;
        font-family:"Open Sans Light", Candara, Arial, sans-serif;
    }
    
    a.bookmark:hover {
        font-weight:bold;
        padding-left:5px;
    }
    
</style> 