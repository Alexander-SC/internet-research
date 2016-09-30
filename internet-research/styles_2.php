<style>
    @font-face {
        font-family:AlexBrush;
        src:url(http://localhost/internet-research/fonts/AlexBrush.ttf)
    }
    
    body {
        background-color: #3399FF;
        font-family:"Open Sans Light", Candara, Arial, sans-serif;
        margin:0;
        padding:0;
        /* Open Sans Light */
    }
    
    header {
        background-color:#F7FBFF;
        border-radius:15px;
        margin:20px auto;
        width:94%;
        height:120px;
    }
    
    div#logo {
        padding:9px 0 0 0;
        text-align:center;
        font-family:AlexBrush;
        font-size:2.5em;
        color:#4d4e53;
        font-weight:bold;
    }
    
/*NAVIGATION*/    
    nav {
        width:100%;
        position:absolute;
        top:88px;
        left:0;
        background-color:#4d4e53;
        padding:3px 0px 3px 0px;
    }

/*FIRST NAV BAR*/
    ul#main-nav {
        list-style-type: none;
        margin:0;
        padding:0 3% 0 3%;
        overflow:hidden;
    }

    li.navbutton1 {
        float: left;
        border-right: 5px solid #4d4e53;
    }
    
    li.currentpage1 {
        text-align:center;
        font-size:1.25em;
        color:#F7FBFF;
        float:right;
        padding:7px 0 0 0;
    }
        
    li:last-child.navbutton1 {
    }

    li a.navlink1 {
        display: block;
        border-radius:5px;
        color: #3399ff;
        text-align: center;
        padding-top: 12px;
        padding-bottom: 3px;
        padding-right: 5px;
        padding-left: 25px;
        background-color: #e6f2ff;
        text-decoration: none;
        font-size:1.1em;
        font-family:Candara, Arial, sans-serif;
        font-weight: bold;
    }
    
    li a.active1 {
        background-color: #5c00e6;
        color:#F7FBFF;
    }
    
    a.navlink1:hover {
        background-color:#3399FF;
        color:#F7FBFF;
    }
    
    a.active1:hover {
        background-color:#A676ED;
    }
        
/*SECOND NAV BAR*/
    ul#second-nav {
        list-style-type: none;
        margin:5px 0 0 0;
        padding:0 3% 0 3%;
        overflow:hidden;
    }

    li.navbutton2 {
        float: left;
        border-right: 5px solid #4d4e53;
    }

    li.currentpage2 {
        text-align:center;
        font-size:1.25em;
        color:#F7FBFF;
        float:right;
        padding:7px 0 0 0;
    }
        
    li:last-child.navbutton2 {
    }

    li a.navlink2 {
        display: block;
        border-radius:3px;
        color: #40424D;
        text-align: center;
        padding-top: 2px;
        padding-bottom: 0px;
        padding-right: 10px;
        padding-left: 10px;
        margin-top:3px;
        background-color:#FAA850;  
        text-decoration: none;
        font-size:1em;
        font-family:Candara, Arial, sans-serif;
    }
    
    li.search-box {
        color:#F7FBFF;
        float:right;
    }
    
    li input {
        border-radius:3px;
        background-color:#F7FBFF;
        border:1px solid #3399FF;
    }
    
    li a.active2 {
        background-color: #5c00e6;
        color:#F7FBFF;
    }
    
    a.navlink2:hover {
        background-color:#3399FF;
        color:#F7FBFF;
    }
            
    div#page-wrap {
        background-color:#F7FBFF;
        width:94%;
        margin:0 auto;
        padding:0px;
        border:0px solid #d1d1e0;
        overflow:auto;
    }
    
    section#side-panel {
        float:left;
        min-height:395px;
        min-width:330px;
        padding:10px;
        background-color:#4D4E53;
        border-top:20px solid #3399FF;
        color:white; 
    }
        
    div#add-link-form {
        width:320px;
        padding:5px;
        overflow:auto;
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
    
    .add-link-input {
        border-radius:7px;
        background-color:#F7FBFF;
        border:1px solid #3399FF;
        width:316px;
        height:20px;
        margin-bottom:7px;
    }
    
    .add-link-input::-webkit-input-placeholder {
        color:#6A6D80;
        padding:0 5px;
    }
    
    .blue1 {
        background-color:#E6F2FF;
    }
    
    .blue2 {
        background-color:#CCE4FF;
    }
    
    .blue3 {
        background-color:#B3D7FF;
    }
    
    input.short {
        width:200px;
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
    
    label.taglabel {
        cursor: pointer;
        font-size:0.8em;
        color:#ABA5B5;
    }
    
    input[type="checkbox"].taglist + label:before {
        border: 1px solid #ABA5B5;
        content: "\00a0";
        display: inline-block;
        font: 1em sans-serif;
        height: 16px;
        margin: 0 .25em 0 0;
        padding: 0;
        vertical-align: top;
        width: 16px;
    }
    input[type="checkbox"]:checked.taglist + label:before {
        background: #4d4e53;
        color:#FAA850;
        content: "\2713";
        text-align: center;
    }
    input[type="checkbox"]:checked.taglist + label:after {
        font-weight: bold;
    }     
    
/* ADD BUTTON */
    input[type="submit"].link-submit {
        background:url(images/add_button.png);
        border:0;
        cursor:pointer;
        width:70px;
        height:40px;
        float:right;
    }
    
    input[type="submit"]:hover.link-submit {
        background:url(images/add_button_hover.png);
    }
    
/* EDIT/SAVE BUTTON */
    input[type="submit"].edit-submit {
        background:url(images/save_button.png);
        border:0;
        cursor:pointer;
        width:70px;
        height:40px;
        float:right;
    }
    
    input[type="submit"]:hover.edit-submit {
        background:url(images/save_button_hover.png);
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
    
    div#top-note {
        padding:3px 40px;
        width:70%;
        margin:auto;
        border:3px solid #4d4e53;
        background-color:#b3b3ff;
        font-size:0.9em;
    }
    
/*FILTER TAGS*/
    li.filter-tags {
        display:block;
        float:left;
        margin-right:30px;
    }
    
    input.filter-tag-checkbox {
        margin-right:1px;
    }
    
    label.filter-tag-label {
        color:#4d4e53;
        text-transform:uppercase;
        font-size:.75em;
    }
    
/*LINK OUTPUT TABLE*/
    section#results_table {
        overflow:hidden;
        margin:0 auto;
    }
    
    table#link_output {
        font-size:0.9em;
        table-layout:fixed;
        border-collapse:collapse;
        border-bottom:3px solid #4d4e53;
        border-left:1px solid #4d4e53;
        border-right:3px solid #4d4e53;
        width:98%;
        margin:0 auto;
    }
    
    table#link_output td {
        font-size:0.92em;
    }
    
    table#link_output tr, th, td {
        overflow:hidden;
        white-space:nowrap;
        text-overflow:ellipsis;
        border-right:1px solid #ABA5B5;
        padding:3px 0px 3px 5px;
    }

    table#link_output th {
        background-color:#5c00e6;
        color:#F7FBFF;
        transition:1s ease;
        height:20px;
    }
    
    table#link_output th.title {
        width:250px;
    }
    
    table#link_output th.title:hover {
        width:300px;
    }
    
    table#link_output th.shortdesc {
        width:275px;
    }
    
    table#link_output th.shortdesc:hover {
        width:475px;
    }
    
    table#link_output th.tags {
        width:150px;
        padding:0 10px;
    }
    
    table#link_output th.tags:hover {
        width:300px;
    }
    
    table#link_output th.notes {
        width:225px;
    }
    
    table#link_output th.notes:hover {
        width:475x;
    }
        
    td.align-left {
        text-align:left;
    }
    
    table#link_output th.edit {
        width:20px;
        padding:0px;
        text-align:center;
    }
    
    table#link_output th.delete {
        width:20px;
        padding:0px;
        text-align:center;
    }
   
    input[type="submit"].delete-x {
        color:#4d4e53;
        padding:0px;
        margin:0px;
        font-size:12px;
        border-top:1px solid #FAA850;
        border-right:3px solid #FAA850;
        border-bottom:3px solid #FAA850;
        border-left:1px solid #FAA850;
        background-color:#FFD3A3;
        height:16px;
        width:16px;
        cursor:pointer;
    }
    
    button[type="send"] {
        cursor:pointer;
        background:none; 
        border:0;
        height:20px;
        width:20px;
        margin:0 0 0 -3px;
        padding:0;
    }
    
    table#link_output tr:nth-child(even) {
        background-color:#E6F2FF;
    }
    
    table#link_output tr:nth-child(odd) {
        background-color:#CCE4FF;
    }
    
    table#link_output tr:hover {
        background-color:#b3b3ff;
    }
    
    table#link_output td:hover {
        white-space:normal;
        text-overflow:clip;
    }
    
    a.bookmark {
        font-size:1.1em;
        
        text-decoration:none;
        display:block;
        font-family:"Open Sans Light", Candara, Arial, sans-serif;
    }
    
    a.bookmark:hover {
        transition-duration:0.25s;
        font-weight:bold;
        padding-left:5px;
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
    
    footer {
        width:100%;
        padding:4px 0;
        background-color:#4D4E53;
        color:#ABA5B5;
        text-align:center;
        margin:10px 0 0 0;
    }
        
</style> 