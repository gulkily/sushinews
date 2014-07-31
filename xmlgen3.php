<?php

include_once('utilities.php');

//header('Content-Type: text/xml');


if (isset($offset)) {
    $limit = 100;
} else {
    $limit = 100;
}

$items = getItems($limit);

$header = array(
    'title' => 's.n',
    'atom_link' => 'http://sushi.local/xmlgen.php',
    'link' => 'http://sushi.local/',
    'description' => 'news edited by you!',
    'language' => 'en-US',
    'lastBuildDate' => 'Thu, 17 Jul 2014 17:10:07 +0000'

);

function printItem($item) {

    /*
     * Array
(
    [title] => Малайзийский Boeing 777 потерпел крушение в Донецкой области
    [body] => 17 июля 2014 года недалеко от российско-украинской границы в Донецкой области потерпел крушение малайзийский Boeing 777-200ER (номер 9M-MRD; рейс 17), на борту которого находилось 280 пассажиров и 15 членов экипажа. Среди пассажиров было 80 детей. Советник главы МВД Украины Антон Геращенко подтвердил гибель всех 280 пассажиров и членов экипажа. Граждан России на борту самолёта не было. Российские источники также подтверждают крушение. Власти Украины возложили ответственность за сбитый самолёт на пророссийских «террористов», ведущих бои в Донецкой и Луганской областях и несколько дней целенаправленно сбивающих самолёты над контролируемой территорией. Сепаратисты категорически отвергают обвинения, указывая, что вооружения, способного сбивать подобные самолёты на такой высоте, у них нет.

    [summary] => 17 июля 2014 года недалеко от российско-украинской границы в Донецкой области потерпел крушение малайзийский Boeing 777-200ER (номер 9M-MRD; рейс 17), на борту которого находилось 280 пассажиров и 15 членов экипажа. Среди пассажиров было 80 детей.
    [id] => 105
    [guid] => cc1c995e911cc9db0e214e74085669dc
)

     */

?>

<?php
}

header('Content-Type:application/xml');
//header('Content-Type:application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="utf-8"?>';
?>


<rdf:RDF
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:cc="http://web.resource.org/cc/"
    xmlns="http://purl.org/rss/1.0/">

<channel rdf:about="http://www.w3.org/">
    <title>W3C News</title>
    <link>http://www.w3.org/</link>
    <description></description>
    <dc:language>en</dc:language>
    <dc:creator>W3C Staff and Contributors</dc:creator>

    <dc:date>2013-09-06T11:24:32-05:00</dc:date>
    <admin:generatorAgent rdf:resource="http://www.movabletype.org/?v=4.34-en" />


    <items>
        <rdf:Seq>
            <rdf:li rdf:resource="http://www.w3.org/News/2013.html#entry-9932" />
            <rdf:li rdf:resource="http://www.w3.org/News/2013.html#entry-9931" />
            <rdf:li rdf:resource="http://www.w3.org/News/2013.html#entry-9930" />
            <rdf:li rdf:resource="http://www.w3.org/News/2013.html#entry-9929" />
            <rdf:li rdf:resource="http://www.w3.org/News/2013.html#entry-9927" />
            <rdf:li rdf:resource="http://www.w3.org/News/2013.html#entry-9926" />
            <rdf:li rdf:resource="http://www.w3.org/News/2013.html#entry-9922" />
            <rdf:li rdf:resource="http://www.w3.org/News/2013.html#entry-9920" />
            <rdf:li rdf:resource="http://www.w3.org/News/2013.html#entry-9919" />
            <rdf:li rdf:resource="http://www.w3.org/News/2013.html#entry-9918" />
            <rdf:li rdf:resource="http://www.w3.org/News/2013.html#entry-9917" />
            <rdf:li rdf:resource="http://www.w3.org/News/2013.html#entry-9915" />
            <rdf:li rdf:resource="http://www.w3.org/News/2013.html#entry-9914" />
            <rdf:li rdf:resource="http://www.w3.org/News/2013.html#entry-9911" />
            <rdf:li rdf:resource="http://www.w3.org/News/2013.html#entry-9910" />
        </rdf:Seq>
    </items>

</channel>


<item rdf:about="http://www.w3.org/News/2013.html#entry-9932">
    <title>Two Drafts in Last Call: N-Triples, N-Quads</title>
    <link>http://www.w3.org/News/2013.html#entry-9932</link>
    <description>        <![CDATA[<p>The <a href="http://www.w3.org/2011/rdf-wg/">RDF Working Group</a> has published two Last Call Working Drafts:</p>
        <ul class="show_items">
            <li> <a href="http://www.w3.org/TR/2013/WD-n-triples-20130905/">N-Triples</a>. N-Triples is a line-based, plain text format for encoding an RDF graph. Comments are welcome through 14 October. </li>
            <li><a href="http://www.w3.org/TR/2013/WD-n-quads-20130905/">N-Quads</a>. N-Quads is a line-based, plain text format for encoding an RDF dataset. Comments are welcome through 14 October.</li>
        </ul>
        <p>Learn more about the <a href="http://www.w3.org/2001/sw/">Semantic Web Activity</a>.</p>]]>
    </description>
    <dc:subject>Semantic Web</dc:subject>
    <dc:creator>Coralie Mercier</dc:creator>
    <dc:language>en</dc:language>
    <dc:date>2013-09-06T11:24:32-05:00</dc:date>
</item>

<item rdf:about="http://www.w3.org/News/2013.html#entry-9931">
    <title>Updated Techniques for Web Content Accessibility Guidelines (WCAG) 2.0 and Understanding WCAG 2.0</title>
    <link>http://www.w3.org/News/2013.html#entry-9931</link>
    <description>        <![CDATA[<p>The <a href="http://www.w3.org/WAI/GL/">Web Content Accessibility Guidelines Working Group</a> today published updates of two Notes that accompany WCAG 2.0: <a href="http://www.w3.org/TR/2013/NOTE-WCAG20-TECHS-20130905/">Techniques for WCAG 2.0</a> and <a href="http://www.w3.org/TR/2013/NOTE-UNDERSTANDING-WCAG20-20130905/">Understanding WCAG 2.0</a>. (This is not an update to WCAG 2.0, which is a stable document.) For background, important information about techniques, and opportunities to contribute to future updates, please see the <a href="http://lists.w3.org/Archives/Public/w3c-wai-ig/2013JulSep/0098.html">Understanding Techniques for WCAG Success Criteria e-mail</a>. Read about the <a href="http://www.w3.org/WAI/">Web Accessibility Initiative (WAI)</a>.</p>]]>
    </description>
    <dc:subject>Web Design and Applications</dc:subject>
    <dc:creator>Coralie Mercier</dc:creator>
    <dc:language>en</dc:language>
    <dc:date>2013-09-05T15:26:31-05:00</dc:date>
</item>

<item rdf:about="http://www.w3.org/News/2013.html#entry-9930">
    <title>Last Call: Media Source Extensions</title>
    <link>http://www.w3.org/News/2013.html#entry-9930</link>
    <description>        <![CDATA[<p>The <a href="http://www.w3.org/html/wg/">HTML Working Group</a> has published a Last Call Working Draft of <a href="http://www.w3.org/TR/2013/WD-media-source-20130905/">Media Source Extensions</a>. This specification extends HTMLMediaElement to allow JavaScript to generate media streams for playback. Allowing JavaScript to generate streams facilitates a variety of use cases like adaptive streaming and time shifting live streams. If you wish to make comments or file bugs regarding this document in a manner that is tracked by the W3C, please submit them via our public bug database. Comments are welcome through 17 October. Learn more about the <a href="http://www.w3.org/MarkUp/Activity">HTML Activity</a>.</p>]]>
    </description>
    <dc:subject>Home Page Stories</dc:subject>
    <dc:creator>Coralie Mercier</dc:creator>
    <dc:language>en</dc:language>
    <dc:date>2013-09-05T15:16:36-05:00</dc:date>
</item>

<item rdf:about="http://www.w3.org/News/2013.html#entry-9929">
    <title>Guidance on Applying WCAG 2.0 to Non-Web ICT: WCAG2ICT Note Published</title>
    <link>http://www.w3.org/News/2013.html#entry-9929</link>
    <description>        <![CDATA[<p>The <a href="http://www.w3.org/WAI/GL/">Web Content Accessibility Guidelines Working Group</a> is pleased to announce publication of the completed <a href="http://www.w3.org/TR/wcag2ict">Guidance on Applying WCAG 2.0 to Non-Web Information and Communications Technologies (WCAG2ICT)</a> as an informative W3C Working Group Note. WCAG2ICT provides guidance on the interpretation and application of WCAG 2.0 to non-web documents and software. It is the result of a collaborative effort to support harmonized accessibility solutions across a range of technologies. Learn more from the <a href="http://www.w3.org/WAI/intro/wcag2ict">WCAG2ICT Overview</a> and read about the <a href="http://www.w3.org/WAI/">Web Accessibility Initiative (WAI)</a>.</p>]]>
    </description>
    <dc:subject>Web Design and Applications</dc:subject>
    <dc:creator>Coralie Mercier</dc:creator>
    <dc:language>en</dc:language>
    <dc:date>2013-09-05T15:10:51-05:00</dc:date>
</item>

<item rdf:about="http://www.w3.org/News/2013.html#entry-9927">
    <title>Media Capture and Streams Draft Published</title>
    <link>http://www.w3.org/News/2013.html#entry-9927</link>
    <description>        <![CDATA[<p>The <a href="http://www.w3.org/2011/04/webrtc/">Web Real-Time Communication Working Group </a> and the <a href="http://www.w3.org/2009/dap">Device APIs Working Group</a> have published an updated Working Draft of <a href="http://www.w3.org/TR/2013/WD-mediacapture-streams-20130516/">Media Capture and Streams</a>. This document defines a set of JavaScript APIs that allow local media, including audio and video, to be requested from a platform. Learn more about the <a href="http://www.w3.org/2007/uwa/">Ubiquitous Web Applications Activity</a>.</p>]]>
    </description>
    <dc:subject>Web Design and Applications</dc:subject>
    <dc:creator>Coralie Mercier</dc:creator>
    <dc:language>en</dc:language>
    <dc:date>2013-09-03T10:29:03-05:00</dc:date>
</item>

<item rdf:about="http://www.w3.org/News/2013.html#entry-9926">
    <title>Registration Open for HTML5 Training Course; Early Bird Rate through 8 September</title>
    <link>http://www.w3.org/News/2013.html#entry-9926</link>
    <description>        <![CDATA[<p><a href="http://classroom.w3devcampus.com/enrol/index.php?id=49">Register now</a> to the upcoming <a href="http://www.w3devcampus.com/html5-w3c-training/">W3C HTML5 online course</a>, to start 30 September 2013. Acclaimed trainer Michel Buffa will cover the techniques developers and designers need to create great Web pages and apps. This new course edition has been significantly enhanced since the June 2013 course. It features additional sections, including a JavaScript crash course, advanced sections on time based animation, 2D geometric transformations, Web Audio API, etc., all illustrated by numerous examples. <a href="http://classroom.w3devcampus.com/enrol/index.php?id=49">Register before September 8</a> to benefit from the early bird rate. Learn more about <a href="http://www.w3devcampus.com/">W3DevCampus</a>, the W3C online training for Web developers.</p>]]>
    </description>
    <dc:subject></dc:subject>
    <dc:creator>Coralie Mercier</dc:creator>
    <dc:language>en</dc:language>
    <dc:date>2013-08-28T11:08:59-05:00</dc:date>
</item>

<item rdf:about="http://www.w3.org/News/2013.html#entry-9922">
    <title>Public Identifiers for entity resolution in XHTML Draft Published</title>
    <link>http://www.w3.org/News/2013.html#entry-9922</link>
    <description>        <![CDATA[<p>The <a href="http://www.w3.org/html/wg/">HTML Working Group</a> has published a Working Draft of <a href="http://www.w3.org/TR/2013/WD-xhtml-pubid-20130822/">Public Identifiers for entity resolution in XHTML</a>. This document adds an additional public identifier that should be recognised by XHTML user agents and cause the HTML character entity definitions to be loaded. Unlike the identifiers already listed by the HTML5 specification, the identifier added by this extension references the set of defintions that is used by HTML. Learn more about the <a href="http://www.w3.org/MarkUp/Activity">HTML Activity</a>.</p>]]>
    </description>
    <dc:subject>Web Design and Applications</dc:subject>
    <dc:creator>Ian Jacobs</dc:creator>
    <dc:language>en</dc:language>
    <dc:date>2013-08-22T13:06:26-05:00</dc:date>
</item>

<item rdf:about="http://www.w3.org/News/2013.html#entry-9920">
    <title>WebCrypto Key Discovery Working Draft Published</title>
    <link>http://www.w3.org/News/2013.html#entry-9920</link>
    <description>        <![CDATA[<p>The <a href="http://www.w3.org/2012/webcrypto/">Web Cryptography Working Group</a> has published a Working Draft of <a href="http://www.w3.org/TR/2013/WD-webcrypto-key-discovery-20130822/">WebCrypto Key Discovery</a>. This specification describes a JavaScript API for discovering named, origin-specific pre-provisioned cryptographic keys for use with the Web Cryptography API. Pre-provisioned keys are keys which have been made available to the user agent by means other than the generation, derivation, importation functions of the Web Cryptography API. Origin-specific keys are keys that are available only to a specified origin. Named keys are identified by a name assumed to be known to the origin in question and provisioned with the key itself. Learn more about the <a href="http://www.w3.org/Security/">Security Activity</a>.</p>]]>
    </description>
    <dc:subject>Web Design and Applications</dc:subject>
    <dc:creator>Ian Jacobs</dc:creator>
    <dc:language>en</dc:language>
    <dc:date>2013-08-22T11:40:18-05:00</dc:date>
</item>

<item rdf:about="http://www.w3.org/News/2013.html#entry-9919">
    <title>Three RDFa Recommendations Published</title>
    <link>http://www.w3.org/News/2013.html#entry-9919</link>
    <description>        <![CDATA[<p>
            <a href="/2001/sw/" class="imageLink">
                <img src="http://www.w3.org/Icons/SW/sw-cube.png" alt="Semantic Web Cube"/>
            </a>
            The <a href="/2010/02/rdfa/">RDFa Working Group</a> today published three RDFa Recommendations. RDFa lets authors put machine-readable data in HTML documents. Using RDFa, authors may turn their existing human-visible text and links into machine-readable data without repeating content. Today's publications were:</p>

        <ul class="show_items">
            <li><a href="http://www.w3.org/TR/2013/REC-html-rdfa-20130822/">HTML+RDFa 1.1</a>,
                which defines rules and guidelines for adapting the RDFa Core 1.1 and RDFa Lite 1.1 specifications for use in HTML5 and XHTML5. The rules defined in this specification not only apply to HTML5 documents in non-XML and XML mode, but also to HTML4 and XHTML documents interpreted through the HTML5 parsing rules.</li>
            <li>The group also published two Second Editions for <a href="http://www.w3.org/TR/2013/REC-rdfa-core-20130822/">RDFa Core 1.1</a> and <a href="http://www.w3.org/TR/2013/REC-xhtml-rdfa-20130822/">XHTML+RDFa 1.1</a>, folding in the errata reported by the community since their publication as Recommendations in June 2012; all changes were editorial.</li>
            <li>The group also updated the a <a href="/TR/2013/NOTE-rdfa-primer-20130822/">RDFa 1.1 Primer</a>.</li>
        </ul>
        <p>Learn more about the <a href="/2001/sw/">Semantic Web Activity</a>.</p>]]>
    </description>
    <dc:subject>Semantic Web</dc:subject>
    <dc:creator>Ian Jacobs</dc:creator>
    <dc:language>en</dc:language>
    <dc:date>2013-08-22T11:15:02-05:00</dc:date>
</item>

<item rdf:about="http://www.w3.org/News/2013.html#entry-9918">
    <title>Last Call: Internationalization Tag Set (ITS) Version 2.0</title>
    <link>http://www.w3.org/News/2013.html#entry-9918</link>
    <description>        <![CDATA[<p>The <a href="http://www.w3.org/International/multilingualweb/lt/">MultilingualWeb-LT Working Group</a> has published a Last Call Working Draft of <a href="http://www.w3.org/TR/2013/WD-its20-20130820/">Internationalization Tag Set (ITS) Version 2.0</a>. ITS 2.0 makes it easier to integrate automated processing of human language into core Web technologies. ITS 2.0 focuses on HTML, XML-based formats in general, and can leverage processing based on the XML Localization Interchange File Format (XLIFF), as well as the Natural Language Processing Interchange Format (NIF). Comments are welcome through 10 September. Learn more about the <a href="http://www.w3.org/International/">Internationalization Activity</a>.</p>]]>
    </description>
    <dc:subject>Web Design and Applications</dc:subject>
    <dc:creator>Ian Jacobs</dc:creator>
    <dc:language>en</dc:language>
    <dc:date>2013-08-21T07:11:34-05:00</dc:date>
</item>

<item rdf:about="http://www.w3.org/News/2013.html#entry-9917">
    <title>W3C Launches Web and Mobile Interest Group</title>
    <link>http://www.w3.org/News/2013.html#entry-9917</link>
    <description>        <![CDATA[<p>W3C launched today a <a href="/Mobile/IG/">Web and Mobile Interest Group</a> that is <a href="http://www.w3.org/2013/07/webmobile-ig-charter.html">chartered</a> to accelerate the development of Web technology so that it becomes a compelling platform for mobile applications and the obvious choice for cross platform development. The forum is intended to include organisations that commission such products and services, designers, developers, equipment manufacturers, tool and platform vendors, browser vendors, operators and other relevant participants in the value chain that creates and operates such products and services. Participants will focus on a wide range of sectors including retail, advertising, technology, network operators, content creation and content distribution.</p>
        <p>The initial <a href="http://www.w3.org/2013/07/webmobile-ig-charter.html#deliverables">deliverables</a> of the group include:</p>
        <ul class="show_items">
            <li>Core Mobile Web Platform 2012 Deployment Status, which will summarize the various actions that the Interest Group is undertaking to ensure that the relevant stakeholders  facilitate the deployment and adoption of the features that have been identified in the <a href="http://coremob.github.io/coremob-2012/FR-coremob-20130131.html">Core Mobile Web Platform 2012 report</a>. The group will also publish new versions of the report</li>
            <li>Standards for Web Applications on Mobile: current state and roadmap, which
                will take a broader look at all the Web technologies under development that are particularly relevant to mobile devices, and tracks their status and adoption.</li>
            <li>A gap analysis that provides an overview of the differences between the Web as a platform on mobile and other popular platforms and ecosystems, both from a technical and commercial perspective.</li>
            <li>Additional reports on use cases and scenarios for context-relevant user experiences, multi-device and cross-device user experiences on the Web, and Usability and Efficiency Considerations for the Web on Mobile.</li>
        </ul>

        <p>Read more about the <a href="http://www.w3.org/Mobile/">Mobile Web Initiative</a>.</p>]]>
    </description>
    <dc:subject>Web of Devices</dc:subject>
    <dc:creator>Ian Jacobs</dc:creator>
    <dc:language>en</dc:language>
    <dc:date>2013-08-20T12:47:57-05:00</dc:date>
</item>

<item rdf:about="http://www.w3.org/News/2013.html#entry-9915">
    <title>Push API and Input Method Editor API Drafts Published</title>
    <link>http://www.w3.org/News/2013.html#entry-9915</link>
    <description>        <![CDATA[<p>The <a href="http://www.w3.org/2008/webapps/">Web Applications Working Group</a> has published two Working Drafts:</p>

        <ul class="show_items">
            <li><a href="http://www.w3.org/TR/2013/WD-push-api-20130815/">Push API</a>. This specification defines a “Push API” that provides webapps with scripted access to server-sent notifications, for simplicity referred to here as push notifications, as delivered by push services. Push services are a way for application servers to send messages to webapps, whether or not the webapp is active in a browser window.</li>
            <li><a href="http://www.w3.org/TR/2013/WD-ime-api-20130815/">Input Method Editor API</a>. This specification defines an “IME API” that provides Web applications with scripted access to an IME (input-method editor) associated with a hosting user agent.</li>
        </ul>

        <p>Learn more about the <a href="http://www.w3.org/2006/rwc/">Rich Web Client Activity</a>.</p>]]>
    </description>
    <dc:subject>Web Design and Applications</dc:subject>
    <dc:creator>Ian Jacobs</dc:creator>
    <dc:language>en</dc:language>
    <dc:date>2013-08-15T13:48:36-05:00</dc:date>
</item>

<item rdf:about="http://www.w3.org/News/2013.html#entry-9914">
    <title>W3C Workshop Report: Smart Homes, Cars, Devices and the Web - Rich Multimodal Apps</title>
    <link>http://www.w3.org/News/2013.html#entry-9914</link>
    <description>        <![CDATA[<p>W3C published today a <a
                href="http://www.w3.org/2013/07/mmi/summary">summary</a> of the
            <a href="http://www.w3.org/2013/07/mmi/">Workshop on Rich
                Multimodal Application Development</a>, hosted by Openstream on
            22-23 July in the New York Metropolitan Area.</p>

        <p>One of the Workshop aims was to accentuate the merits of <a
                href="http://www.w3.org/TR/html5/">HTML5</a> and the <a
                href="http://www.w3.org/TR/mmi-arch/">W3C Multimodal
                Architecture</a> to help create the appropriate level of
            awareness of the maturity of the MMI Architecture and its
            suitability for developing innovative and compelling
            user-experiences across applications/devices.</p>

        <p>Workshop participants prioritized work on use cases and
            requirements for rich multimodal applications, including
            service/device discovery, HTML5 integration, extending <a
                href="http://www.w3.org/TR/emma11/">EMMA</a> for output, specific
            industry snapshot, streaming, timing handling and related
            standards.</p>

        <p>As discussed during the workshop, the W3C Multimodal
            Interaction Working Group will hold Webinars like the <a
                href="http://event.on24.com/eventRegistration/EventLobbyServlet?target=lobby.jsp&amp;eventid=567980&amp;sessionid=1&amp;key=3D02EAC371B0A72EA1C51DCA6CE14996&amp;eventuserid=74776302">one
                held in January</a> to discuss the issues identified during the
            workshop with all the stakeholders.  Learn more about the <a
                href="http://www.w3.org/2002/mmi/Activity">Multimodal Interaction
                Activity</a>.</p>
        ]]>
    </description>
    <dc:subject>Web of Devices</dc:subject>
    <dc:creator>Ian Jacobs</dc:creator>
    <dc:language>en</dc:language>
    <dc:date>2013-08-14T07:20:33-05:00</dc:date>
</item>

<item rdf:about="http://www.w3.org/News/2013.html#entry-9911">
    <title>HTML5 and Canvas 2D Candidate Recommendations Updated by the HTML Working Group</title>
    <link>http://www.w3.org/News/2013.html#entry-9911</link>
    <description>        <![CDATA[<p>The <a href="http://www.w3.org/html/wg/">HTML Working Group</a> updated two Candidate Recommendations today:</p>
        <ul class="show_items">
            <li><a href="http://www.w3.org/TR/2013/CR-html5-20130806/">HTML5</a>, which defines the 5th major revision of the core language of the World Wide Web, the Hypertext Markup Language (HTML). In this version, new features are introduced to help Web application authors, new elements are introduced based on research into prevailing authoring practices, and special attention has been given to defining clear conformance criteria for user agents in an effort to improve interoperability.</li>
            <li><a href="http://www.w3.org/TR/2013/CR-2dcontext-20130806/">HTML Canvas 2D Context</a>, which defines the 2D Context for the HTML canvas element. The 2D Context provides objects, methods, and properties to draw and manipulate graphics on a canvas drawing surface.</li>
        </ul>
        <p>Learn more about the <a href="http://www.w3.org/MarkUp/Activity">HTML Activity</a>.</p>]]>
    </description>
    <dc:subject>Web Design and Applications</dc:subject>
    <dc:creator>Coralie Mercier</dc:creator>
    <dc:language>en</dc:language>
    <dc:date>2013-08-06T12:24:29-05:00</dc:date>
</item>

<item rdf:about="http://www.w3.org/News/2013.html#entry-9910">
    <title>W3C Highlights - August 2013</title>
    <link>http://www.w3.org/News/2013.html#entry-9910</link>
    <description>        <![CDATA[<p>Today, W3C published <a href="http://www.w3.org/2013/08/w3c-highlights/">W3C Highlights - August 2013</a>, a survey of select recent work and upcoming priorities. The report includes: progress and work ahead in making the Open Web Platform
            a success on mobile devices, news in Web for All areas like accessibility
            and internationalization, how W3C is collaborating more closely with various industries that are being
            transformed by the Web, liaison updates, and new opportunities for more people to get involved in W3C.</p>]]>
    </description>
    <dc:subject></dc:subject>
    <dc:creator>Coralie Mercier</dc:creator>
    <dc:language>en</dc:language>
    <dc:date>2013-08-01T15:30:48-05:00</dc:date>
</item>


<?php

foreach($items as $item) {
//    printItem($item);
}

?>
</rdf:RDF>
