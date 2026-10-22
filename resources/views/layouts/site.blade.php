<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', setting('meta_title', 'NhaTrangRide'))</title>
    <meta name="description" content="@yield('description', setting('meta_description'))">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "on-surface": "#0b1c30",
                        "surface-container": "#e5eeff",
                        "secondary-fixed": "#cce5ff",
                        "surface-container-lowest": "#ffffff",
                        "on-background": "#0b1c30",
                        "primary-fixed": "#d1e4ff",
                        "on-tertiary": "#ffffff",
                        "on-primary-fixed-variant": "#314863",
                        "surface-container-high": "#dce9ff",
                        "inverse-on-surface": "#eaf1ff",
                        "surface-container-low": "#eff4ff",
                        "inverse-primary": "#b0c9e8",
                        "error": "#ba1a1a",
                        "background": "#f8f9ff",
                        "on-tertiary-container": "#c77f00",
                        "tertiary-fixed": "#ffddb8",
                        "on-tertiary-fixed-variant": "#653e00",
                        "on-error-container": "#93000a",
                        "on-secondary-container": "#00476e",
                        "on-primary-container": "#7991af",
                        "on-secondary": "#ffffff",
                        "on-secondary-fixed": "#001d31",
                        "surface-variant": "#d3e4fe",
                        "secondary-container": "#5bb8fe",
                        "on-surface-variant": "#43474d",
                        "surface-tint": "#49607c",
                        "primary": "#001428",
                        "inverse-surface": "#213145",
                        "on-error": "#ffffff",
                        "tertiary-fixed-dim": "#ffb95f",
                        "primary-container": "#0f2942",
                        "outline-variant": "#c3c6ce",
                        "on-secondary-fixed-variant": "#004b73",
                        "surface": "#f8f9ff",
                        "secondary": "#006398",
                        "on-tertiary-fixed": "#2a1700",
                        "error-container": "#ffdad6",
                        "outline": "#74777e",
                        "secondary-fixed-dim": "#93ccff",
                        "tertiary-container": "#3b2200",
                        "on-primary": "#ffffff",
                        "primary-fixed-dim": "#b0c9e8",
                        "surface-container-highest": "#d3e4fe",
                        "surface-bright": "#f8f9ff",
                        "on-primary-fixed": "#011d35",
                        "tertiary": "#1f1000",
                        "surface-dim": "#cbdbf5"
                    },
                    borderRadius: { DEFAULT: "0.25rem", lg: "0.5rem", xl: "0.75rem", full: "9999px" },
                    spacing: {
                        "space-md": "1rem", "margin-lg": "3rem", margin: "1rem", "space-xl": "2.5rem",
                        "space-lg": "1.5rem", "space-xs": "0.25rem", "gutter-lg": "2rem", "space-sm": "0.5rem",
                        gutter: "1rem", "margin-md": "2rem", "gutter-md": "1.5rem"
                    },
                    fontFamily: {
                        "label-sm": ["Plus Jakarta Sans"], "display-mobile": ["Plus Jakarta Sans"],
                        display: ["Plus Jakarta Sans"], "body-md": ["Be Vietnam Pro"],
                        "headline-lg-mobile": ["Plus Jakarta Sans"], "headline-sm": ["Plus Jakarta Sans"],
                        "label-lg": ["Plus Jakarta Sans"], "headline-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"], "label-md": ["Plus Jakarta Sans"],
                        "body-lg": ["Be Vietnam Pro"], "body-sm": ["Be Vietnam Pro"]
                    },
                    fontSize: {
                        "label-sm": ["12px", { lineHeight: "16px", letterSpacing: "0.02em", fontWeight: "700" }],
                        "display-mobile": ["32px", { lineHeight: "40px", letterSpacing: "-0.02em", fontWeight: "800" }],
                        display: ["44px", { lineHeight: "52px", letterSpacing: "-0.02em", fontWeight: "800" }],
                        "body-md": ["16px", { lineHeight: "24px", fontWeight: "400" }],
                        "headline-lg-mobile": ["24px", { lineHeight: "32px", letterSpacing: "-0.015em", fontWeight: "700" }],
                        "headline-sm": ["20px", { lineHeight: "28px", fontWeight: "600" }],
                        "label-lg": ["16px", { lineHeight: "24px", letterSpacing: "0.01em", fontWeight: "600" }],
                        "headline-lg": ["32px", { lineHeight: "40px", letterSpacing: "-0.015em", fontWeight: "700" }],
                        "headline-md": ["24px", { lineHeight: "32px", letterSpacing: "-0.01em", fontWeight: "700" }],
                        "label-md": ["14px", { lineHeight: "20px", letterSpacing: "0.01em", fontWeight: "600" }],
                        "body-lg": ["18px", { lineHeight: "28px", fontWeight: "400" }],
                        "body-sm": ["14px", { lineHeight: "20px", fontWeight: "400" }]
                    }
                }
            }
        };
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 500, 'GRAD' 0, 'opsz' 24; }
        @media (max-width: 1023px) {
            .font-display.text-display { font-size: 32px; line-height: 40px; }
        }
    </style>
</head>
<body class="bg-surface font-body-md text-body-md text-on-surface antialiased selection:bg-secondary-container selection:text-on-secondary-container"
      data-booking-url="{{ route('booking') }}"
      data-roundtrip-discount="{{ (int) setting('roundtrip_discount', '10') }}">
    @include('partials.header')
    <main class="w-full pt-20 bg-surface">
        @yield('content')
    </main>
    @include('partials.footer')
    @include('partials.success-modal')
    @include('partials.scripts')
</body>
</html>
