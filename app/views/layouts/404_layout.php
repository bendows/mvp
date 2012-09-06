<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?=$this->title;?></title>
	<?=$headers;?>
    <!--[if lt IE 7]>
    <style media="screen" type="text/css">
    .col1 {
	    width:100%;
		}
    </style>
    <![endif]-->
</head>
<body>

<div id="header">
<img src="/img/mvplogo.png" style='border:1px solid silver;'>
</div>
<div class="colmask holygrail">
    <div class="colmid">
        <div class="colleft">
            <div class="col1wrap">
                <div class="col1">
					<!-- Column 1 start -->
					<h2>Em dimensions of the holy grail layout</h2>
				    <p>In this layout the side column widths are in ems and the centre page adjusts in size to fill the rest of the screen. Vertical dimensions are left unset so they automatically stretch to the height of the content. Layouts that use em widths are great when you want text to always line-break at the same point regardless of the text size. When you resize the text in your browser the width of the columns changes at the same rate.</p>
				    <h2>The nested div structure</h2>
    				<p>I've colour coded each div so it's easy to see:</p>
    				<p>The header, colmask and footer divs are 100% wide and stacked vertically one after the other. Colmid is inside colmask and colleft is inside colmid. The left and right content columns are inside colleft. The center column needs to be inside the col1wrap div so it can be positioned correctly (This extra div is not required on the <a href="perfect-3-column.htm">percentage width version</a>). Notice that the main content column (col1) comes before the other columns.</p>
    				<!-- Column 1 end -->
                </div>
            </div>
            <div class="col2">
				<!-- Column 2 start -->
                <h2>No CSS hacks</h2>
                <p>The CSS used for this layout is 100% valid and hack free. To overcome Internet Explorer's broken box model, no horizontal padding or margins are used. Instead, this design uses pixel widths and clever relative positioning.</p>
                <h2>SEO friendly 2-1-3 column ordering</h2>
                <p>The higher up content is in your page code, the more important it is considered by search engine algorithms. To make your website as optimised as possible your main page content must come before the side columns. This layout does exactly that: The center page comes first, then the left column and finally the right column (see the nested div structure diagram for more info). The columns can also be configured to any other order if required.</p>
                <h2>Equal height columns</h2>
                <p>It doesn't matter which column has the longest content, the background colour of all columns will stretch down to meet the footer. This feature was traditionally only available with table based layouts but now with a little CSS trickery we can do exactly the same with divs. Say goodbye to annoying short columns!</p>
                <h2>No Images</h2>
				<p>This layout requires no images. Many CSS website designs need images to colour in the column backgrounds but that is not necessary with this design. Why waste bandwidth and precious HTTP requests when you can do everything in pure CSS and XHTML?</p>
				<h2>No JavaScript</h2>
				<p>JavaScript is not required. Some website layouts rely on JavaScript hacks to resize divs and force elements into place but you won't see any of that nonsense here.</p>
                <!-- Column 2 end -->
            </div>
            <div class="col3">
				<!-- Column 3 start -->
                <h2>Full cross-browser support</h2>
				<p>The holy grail 3 column liquid Layout has been tested on the following browsers:</p>

				<h3>iPhone &amp; iPod Touch</h3>
				<ul>
					<li>Safari</li>
				</ul>
				<h3>Mac</h3>
				<ul>
					<li>Safari</li>
					<li>Firefox</li>
					<li>Opera 9.25</li>
					<li>Netscape 9.0.0.5 &amp; 7.1</li>
				</ul>
				<h3>Windows</h3>
				<ul>
					<li>Firefox 1.5 &amp; 2</li>

					<li>Safari</li>
					<li>Opera 8.1 &amp; 9</li>
					<li>Explorer 5.5, 6 &amp; 7</li>
					<li>Netscape 8</li>
				</ul>
                <h2>Valid XHTML strict markup</h2>
				<p>The HTML in this layout validates as XHTML 1.0 strict.</p>
                <h2>Resizable text compatible</h2>
				<p>This layout is fully compatible with resizable text. Resizable text is important for web accessibility. People who are vision impaired can make the text larger so it's easier for them to read. It is becoming increasingly more important to make your website resizable text compatible because people are expecting higher levels of web accessibility. Apple have made resizing the text on a website simple with the pinch gesture on their multi-touch trackpad. So far this trackpad is only available on the MacBook Air but it will soon be rolled out to all of their systems. Is your website text-resizing compatible?</p>
				<h2>FREE for anyone to use</h2>
                <p>You don't have to pay anything. Simply view the source of this page and save the HTML onto your computer. My only suggestion is to <a href="http://matthewjamestaylor.com/blog/adding-css-to-html-with-link-embed-inline-and-import">put the CSS into a separate file</a>. If you are feeling generous however, link back to this page so other people can find and use this layout too.</p>
                <h2>Free traffic for your website</h2>
                <p>If you use this layout for your website <a href="http://matthewjamestaylor.com/about">send me an email</a> with the link and any other information you have so I can add you to my list of example sites. Once I have a few links I'll publish them on my website and you'll get free traffic!</p>
				<!-- Column 3 end -->
            </div>
        </div>
    </div>
</div>
<div id="footer">
    <p>This page uses the <a href="http://matthewjamestaylor.com/blog/ultimate-3-column-holy-grail-ems.htm">Ultimate 'Holy Grail' 3 column Liquid Layout</a> by <a href="http://matthewjamestaylor.com">Matthew James Taylor</a>. View more <a href="http://matthewjamestaylor.com/blog/-website-layouts">website layouts</a> and <a href="http://matthewjamestaylor.com/blog/-web-design">web design articles</a>.</p>
</div>
</body>
</html>
