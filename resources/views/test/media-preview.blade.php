<!DOCTYPE html>
<html>
<head>
    <title>DDA Media Assets Preview</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #1c150d;
            color: #f7f4eb;
            margin: 0;
            padding: 40px;
        }
        h1 {
            color: #ccaa3e;
            border-bottom: 1px solid #ccaa3e;
            padding-bottom: 10px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        .card {
            background: #2a1f10;
            border: 1px solid #45341d;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .media-container {
            width: 100%;
            height: 200px;
            background: #110b06;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .media-container img, .media-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .info {
            padding: 15px;
            font-size: 14px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .filename {
            font-weight: bold;
            color: #ccaa3e;
            word-break: break-all;
            margin-bottom: 5px;
        }
        .size {
            color: #a49685;
            font-size: 12px;
        }
        .no-preview {
            color: #a49685;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Deities Design Awards - Media Assets Preview</h1>
    <p>Open this page on your local server: <a href='http://localhost:8000/media_preview.html' style='color:#457f89;text-decoration:none;'>http://localhost:8000/media_preview.html</a></p>
    <div class='grid'>
        <div class='card'>
            <div class='media-container'>
                <video autoplay muted loop playsinline src='{{ asset('testdda/Images/Artisans_making_Indian_temple_je…_202606051817.mp4') }}'></video>            </div>
            <div class='info'>
                <div class='filename'>Artisans_making_Indian_temple_je…_202606051817.mp4</div>
                <div class='size'>Size: 10.42 MB</div>
            </div>
        </div>
        <div class='card'>
            <div class='media-container'>
                <img src='{{ asset('testdda/Images/Closeup%20artisan%20hands%20making%20setting%20gold%20jewellery,%20tools,%20wax%20model,%20filigree,%20gemstone%20setting.png') }}' alt='Closeup artisan hands making setting gold jewellery, tools, wax model, filigree, gemstone setting.png'>            </div>
            <div class='info'>
                <div class='filename'>Closeup artisan hands making setting gold jewellery, tools, wax model, filigree, gemstone setting.png</div>
                <div class='size'>Size: 2.28 MB</div>
            </div>
        </div>
        <div class='card'>
            <div class='media-container'>
                <img src='{{ asset('testdda/Images/Conceptual%20sacred%20jewellery%20composition%20crown,%20necklace,%20gemstones,%20temple%20motifs,%20dramatic%20editorial%20lighting.png') }}' alt='Conceptual sacred jewellery composition crown, necklace, gemstones, temple motifs, dramatic editorial lighting.png'>            </div>
            <div class='info'>
                <div class='filename'>Conceptual sacred jewellery composition crown, necklace, gemstones, temple motifs, dramatic editorial lighting.png</div>
                <div class='size'>Size: 2.63 MB</div>
            </div>
        </div>
        <div class='card'>
            <div class='media-container'>
                <img src='{{ asset('testdda/Images/Designer%20sketching%20temple%20jewellery,%20mood%20boards,%20CAD%20design%20desk,%20elegant%20studio.png') }}' alt='Designer sketching temple jewellery, mood boards, CAD design desk, elegant studio.png'>            </div>
            <div class='info'>
                <div class='filename'>Designer sketching temple jewellery, mood boards, CAD design desk, elegant studio.png</div>
                <div class='size'>Size: 2.28 MB</div>
            </div>
        </div>
        <div class='card'>
            <div class='media-container'>
                <img src='{{ asset('testdda/Images/Elegant%20panel%20jury%20scene,%20luxury%20awards%20judging%20table,%20jewellery%20sketches%20and%20pieces%20under%20review.png') }}' alt='Elegant panel jury scene, luxury awards judging table, jewellery sketches and pieces under review.png'>            </div>
            <div class='info'>
                <div class='filename'>Elegant panel jury scene, luxury awards judging table, jewellery sketches and pieces under review.png</div>
                <div class='size'>Size: 2.04 MB</div>
            </div>
        </div>
        <div class='card'>
            <div class='media-container'>
                <img src='{{ asset('testdda/Images/Heritage%20Indian%20jewellery%20house%20mood%20antique%20gold%20pieces,%20royal%20temple%20jewellery,%20archival%20luxury%20feel.png') }}' alt='Heritage Indian jewellery house mood antique gold pieces, royal temple jewellery, archival luxury feel.png'>            </div>
            <div class='info'>
                <div class='filename'>Heritage Indian jewellery house mood antique gold pieces, royal temple jewellery, archival luxury feel.png</div>
                <div class='size'>Size: 2.39 MB</div>
            </div>
        </div>
        <div class='card'>
            <div class='media-container'>
                <img src='{{ asset('testdda/Images/Heritage%20houses%20and%20contemporary%20labels%20Luxury%20jewellery%20showroom%20curated%20display%20of%20devotional%20collection.png') }}' alt='Heritage houses and contemporary labels Luxury jewellery showroom curated display of devotional collection.png'>            </div>
            <div class='info'>
                <div class='filename'>Heritage houses and contemporary labels Luxury jewellery showroom curated display of devotional collection.png</div>
                <div class='size'>Size: 2.27 MB</div>
            </div>
        </div>
        <div class='card'>
            <div class='media-container'>
                <video autoplay muted loop playsinline src='{{ asset('testdda/Images/Indian_jewellery_awards_gala_202606051826.mp4') }}'></video>            </div>
            <div class='info'>
                <div class='filename'>Indian_jewellery_awards_gala_202606051826.mp4</div>
                <div class='size'>Size: 11.66 MB</div>
            </div>
        </div>
        <div class='card'>
            <div class='media-container'>
                <video autoplay muted loop playsinline src='{{ asset('testdda/Images/Indian_temple_jewellery_awards_w…_202606051825.mp4') }}'></video>            </div>
            <div class='info'>
                <div class='filename'>Indian_temple_jewellery_awards_w…_202606051825.mp4</div>
                <div class='size'>Size: 17.87 MB</div>
            </div>
        </div>
        <div class='card'>
            <div class='media-container'>
                <img src='{{ asset('testdda/Images/Indias%20first%20awards%20platform%20dedicated%20to%20jewellery%20created%20for%20the%20divine.png') }}' alt='It was always devotion'>            </div>
            <div class='info'>
                <div class='filename'>It was always devotion.png</div>
                <div class='size'>Size: 2.51 MB</div>
            </div>
        </div>
        <div class='card'>
            <div class='media-container'>
                <video autoplay muted loop playsinline src='{{ asset('testdda/Images/Jewellery_showcase_luxury_exhibi…_202606051826.mp4') }}'></video>            </div>
            <div class='info'>
                <div class='filename'>Jewellery_showcase_luxury_exhibi…_202606051826.mp4</div>
                <div class='size'>Size: 13.26 MB</div>
            </div>
        </div>
        <div class='card'>
            <div class='media-container'>
                <img src='{{ asset('testdda/Images/Macro%20diamonds,%20loupe%20inspection,%20diamond%20sorting%20tray,%20clean%20premium%20lighting.png') }}' alt='Macro diamonds, loupe inspection, diamond sorting tray, clean premium lighting.png'>            </div>
            <div class='info'>
                <div class='filename'>Macro diamonds, loupe inspection, diamond sorting tray, clean premium lighting.png</div>
                <div class='size'>Size: 2.14 MB</div>
            </div>
        </div>
        <div class='card'>
            <div class='media-container'>
                <img src='{{ asset('testdda/Images/Macro%20gemstones%20ruby,%20emerald,%20sapphire,%20diamonds,%20navaratna%20style%20sacred%20stone%20arrangement.png') }}' alt='Macro gemstones ruby, emerald, sapphire, diamonds, navaratna style sacred stone arrangement.png'>            </div>
            <div class='info'>
                <div class='filename'>Macro gemstones ruby, emerald, sapphire, diamonds, navaratna style sacred stone arrangement.png</div>
                <div class='size'>Size: 2.27 MB</div>
            </div>
        </div>
        <div class='card'>
            <div class='media-container'>
                <img src='{{ asset('testdda/Images/Macro%20shot%20of%20rich%2022k%20gold%20texture,%20gold%20bangles%20crown%20details,%20warm%20polished%20metal.png') }}' alt='Macro shot of rich 22k gold texture, gold bangles crown details, warm polished metal.png'>            </div>
            <div class='info'>
                <div class='filename'>Macro shot of rich 22k gold texture, gold bangles crown details, warm polished metal.png</div>
                <div class='size'>Size: 2.42 MB</div>
            </div>
        </div>
        <div class='card'>
            <div class='media-container'>
                <img src='{{ asset('testdda/Images/Traditional%20temple%20jewellery%20set,%20goddess%20deity%20ornaments,%20South%20Indian%20temple%20jewellery%20details.png') }}' alt='Traditional temple jewellery set, goddess deity ornaments, South Indian temple jewellery details.png'>            </div>
            <div class='info'>
                <div class='filename'>Traditional temple jewellery set, goddess deity ornaments, South Indian temple jewellery details.png</div>
                <div class='size'>Size: 2.53 MB</div>
            </div>
        </div>
    </div>
</body>
</html>