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
    <h1>Deities Design Awards — Media Assets Preview</h1>
    <p>Open this page at: <a href="{{ url('/deitiesdesignawards/media-preview') }}" style="color:#457f89;text-decoration:none;">{{ url('/deitiesdesignawards/media-preview') }}</a></p>

    <div class="grid">

        {{-- Video: Artisans making Indian temple jewellery --}}
        <div class="card">
            <div class="media-container">
                <video autoplay muted loop playsinline src="{{ asset('deitiesdesignawards/images/Artisans_making_Indian_temple_je…_202606051817.mp4') }}"></video>
            </div>
            <div class="info">
                <div class="filename">Artisans_making_Indian_temple_je…_202606051817.mp4</div>
                <div class="size">Size: 10.42 MB</div>
            </div>
        </div>

        {{-- Image: Closeup artisan hands --}}
        <div class="card">
            <div class="media-container">
                <img src="{{ asset('deitiesdesignawards/images/Closeup artisan hands making setting gold jewellery, tools, wax model, filigree, gemstone setting.png') }}" alt="Closeup artisan hands making setting gold jewellery, tools, wax model, filigree, gemstone setting.png">
            </div>
            <div class="info">
                <div class="filename">Closeup artisan hands making setting gold jewellery, tools, wax model, filigree, gemstone setting.png</div>
                <div class="size">Size: 2.28 MB</div>
            </div>
        </div>

        {{-- Image: Conceptual sacred jewellery composition --}}
        <div class="card">
            <div class="media-container">
                <img src="{{ asset('deitiesdesignawards/images/Conceptual sacred jewellery composition crown, necklace, gemstones, temple motifs, dramatic editorial lighting.png') }}" alt="Conceptual sacred jewellery composition crown, necklace, gemstones, temple motifs, dramatic editorial lighting.png">
            </div>
            <div class="info">
                <div class="filename">Conceptual sacred jewellery composition crown, necklace, gemstones, temple motifs, dramatic editorial lighting.png</div>
                <div class="size">Size: 2.63 MB</div>
            </div>
        </div>

        {{-- Image: Designer sketching temple jewellery --}}
        <div class="card">
            <div class="media-container">
                <img src="{{ asset('deitiesdesignawards/images/Designer sketching temple jewellery, mood boards, CAD design desk, elegant studio.png') }}" alt="Designer sketching temple jewellery, mood boards, CAD design desk, elegant studio.png">
            </div>
            <div class="info">
                <div class="filename">Designer sketching temple jewellery, mood boards, CAD design desk, elegant studio.png</div>
                <div class="size">Size: 2.28 MB</div>
            </div>
        </div>

        {{-- Image: Elegant panel jury scene --}}
        <div class="card">
            <div class="media-container">
                <img src="{{ asset('deitiesdesignawards/images/Elegant panel jury scene, luxury awards judging table, jewellery sketches and pieces under review.png') }}" alt="Elegant panel jury scene, luxury awards judging table, jewellery sketches and pieces under review.png">
            </div>
            <div class="info">
                <div class="filename">Elegant panel jury scene, luxury awards judging table, jewellery sketches and pieces under review.png</div>
                <div class="size">Size: 2.04 MB</div>
            </div>
        </div>

        {{-- Image: Heritage Indian jewellery house mood --}}
        <div class="card">
            <div class="media-container">
                <img src="{{ asset('deitiesdesignawards/images/Heritage Indian jewellery house mood antique gold pieces, royal temple jewellery, archival luxury feel.png') }}" alt="Heritage Indian jewellery house mood antique gold pieces, royal temple jewellery, archival luxury feel.png">
            </div>
            <div class="info">
                <div class="filename">Heritage Indian jewellery house mood antique gold pieces, royal temple jewellery, archival luxury feel.png</div>
                <div class="size">Size: 2.39 MB</div>
            </div>
        </div>

        {{-- Image: Heritage houses and contemporary labels --}}
        <div class="card">
            <div class="media-container">
                <img src="{{ asset('deitiesdesignawards/images/Heritage houses and contemporary labels Luxury jewellery showroom curated display of devotional collection.png') }}" alt="Heritage houses and contemporary labels Luxury jewellery showroom curated display of devotional collection.png">
            </div>
            <div class="info">
                <div class="filename">Heritage houses and contemporary labels Luxury jewellery showroom curated display of devotional collection.png</div>
                <div class="size">Size: 2.27 MB</div>
            </div>
        </div>

        {{-- Video: Indian jewellery awards gala --}}
        <div class="card">
            <div class="media-container">
                <video autoplay muted loop playsinline src="{{ asset('deitiesdesignawards/images/Indian_jewellery_awards_gala_202606051826.mp4') }}"></video>
            </div>
            <div class="info">
                <div class="filename">Indian_jewellery_awards_gala_202606051826.mp4</div>
                <div class="size">Size: 11.66 MB</div>
            </div>
        </div>

        {{-- Video: Indian temple jewellery awards --}}
        <div class="card">
            <div class="media-container">
                <video autoplay muted loop playsinline src="{{ asset('deitiesdesignawards/images/Indian_temple_jewellery_awards_w…_202606051825.mp4') }}"></video>
            </div>
            <div class="info">
                <div class="filename">Indian_temple_jewellery_awards_w…_202606051825.mp4</div>
                <div class="size">Size: 17.87 MB</div>
            </div>
        </div>

        {{-- Image: It was always devotion --}}
        <div class="card">
            <div class="media-container">
                <img src="{{ asset('deitiesdesignawards/images/Indias first awards platform dedicated to jewellery created for the divine.png') }}" alt="It was always devotion">
            </div>
            <div class="info">
                <div class="filename">It was always devotion.png</div>
                <div class="size">Size: 2.51 MB</div>
            </div>
        </div>

        {{-- Video: Jewellery showcase luxury exhibition --}}
        <div class="card">
            <div class="media-container">
                <video autoplay muted loop playsinline src="{{ asset('deitiesdesignawards/images/Jewellery_showcase_luxury_exhibi…_202606051826.mp4') }}"></video>
            </div>
            <div class="info">
                <div class="filename">Jewellery_showcase_luxury_exhibi…_202606051826.mp4</div>
                <div class="size">Size: 13.26 MB</div>
            </div>
        </div>

        {{-- Image: Macro diamonds --}}
        <div class="card">
            <div class="media-container">
                <img src="{{ asset('deitiesdesignawards/images/Macro diamonds, loupe inspection, diamond sorting tray, clean premium lighting.png') }}" alt="Macro diamonds, loupe inspection, diamond sorting tray, clean premium lighting.png">
            </div>
            <div class="info">
                <div class="filename">Macro diamonds, loupe inspection, diamond sorting tray, clean premium lighting.png</div>
                <div class="size">Size: 2.14 MB</div>
            </div>
        </div>

        {{-- Image: Macro gemstones --}}
        <div class="card">
            <div class="media-container">
                <img src="{{ asset('deitiesdesignawards/images/Macro gemstones ruby, emerald, sapphire, diamonds, navaratna style sacred stone arrangement.png') }}" alt="Macro gemstones ruby, emerald, sapphire, diamonds, navaratna style sacred stone arrangement.png">
            </div>
            <div class="info">
                <div class="filename">Macro gemstones ruby, emerald, sapphire, diamonds, navaratna style sacred stone arrangement.png</div>
                <div class="size">Size: 2.27 MB</div>
            </div>
        </div>

        {{-- Image: Macro shot of rich 22k gold texture --}}
        <div class="card">
            <div class="media-container">
                <img src="{{ asset('deitiesdesignawards/images/Macro shot of rich 22k gold texture, gold bangles crown details, warm polished metal.png') }}" alt="Macro shot of rich 22k gold texture, gold bangles crown details, warm polished metal.png">
            </div>
            <div class="info">
                <div class="filename">Macro shot of rich 22k gold texture, gold bangles crown details, warm polished metal.png</div>
                <div class="size">Size: 2.42 MB</div>
            </div>
        </div>

        {{-- Image: Traditional temple jewellery set --}}
        <div class="card">
            <div class="media-container">
                <img src="{{ asset('deitiesdesignawards/images/Traditional temple jewellery set, goddess deity ornaments, South Indian temple jewellery details.png') }}" alt="Traditional temple jewellery set, goddess deity ornaments, South Indian temple jewellery details.png">
            </div>
            <div class="info">
                <div class="filename">Traditional temple jewellery set, goddess deity ornaments, South Indian temple jewellery details.png</div>
                <div class="size">Size: 2.53 MB</div>
            </div>
        </div>

    </div>
</body>
</html>