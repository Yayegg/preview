<?php

declare(strict_types=1);

/**
 * AfrilandCorp flagship portfolio.
 *
 * This single array drives every rendering of a project: the hero
 * dossier covers, the information panel and the project detail pages.
 * Add, remove or reorder projects here and the whole page follows.
 *
 * Keys:
 *  - slug      URL identifier
 *  - group     sector family shown in the quick-browse chip row
 *  - number    prospectus number printed on the cover
 *  - title     project name
 *  - tagline   one-line positioning
 *  - sector    investment sector label
 *  - location  primary geography
 *  - stage     investment stage
 *  - capital   estimated capital requirement
 *  - description  short investor-facing summary
 *  - accent    brand accent colour for the cover and highlights
 *  - palette   cover base: 'forest', 'charcoal' or 'ember' (an optional
 *              brand-orange cover with white text)
 *  - motif     key of the engraved cover artwork (see motif_svg())
 *  - image     optional path to aerial photography for the cover art
 *              area; when null the engraved motif is used instead
 */
return [
    [
        'slug'        => 'oporc',
        'group'       => 'Agro-Industry',
        'number'      => '01',
        'title'       => 'ÔPorc',
        'tagline'     => 'Modern Livestock Platform',
        'sector'      => 'Livestock & Animal Protein',
        'location'    => 'Centre Region, Cameroon',
        'stage'       => 'Operational — Scaling',
        'capital'     => 'US$ 4.5M',
        'description' => 'An integrated pig-farming, feed and processing platform bringing traceable, bio-secure pork production to Central African markets — from genetics to branded retail.',
        'accent'      => '#c98352',
        'palette'     => 'forest',
        'motif'       => 'livestock',
        'image'       => null,
    ],
    [
        'slug'        => 'palm-oil-complex',
        'group'       => 'Agro-Industry',
        'number'      => '02',
        'title'       => 'Palm Oil Industrial Complex',
        'tagline'     => 'Integrated Edible Oils',
        'sector'      => 'Agro-Industry & Edible Oils',
        'location'    => 'Littoral Region, Cameroon',
        'stage'       => 'Feasibility Complete',
        'capital'     => 'US$ 12M',
        'description' => 'A vertically integrated plantation, milling and refining complex producing sustainable crude and refined palm oil for a structurally under-supplied regional market.',
        'accent'      => '#a3b457',
        'palette'     => 'charcoal',
        'motif'       => 'palm',
        'image'       => null,
    ],
    [
        'slug'        => 'evergreen-charcoal',
        'group'       => 'Energy',
        'number'      => '03',
        'title'       => 'Evergreen Charcoal',
        'tagline'     => 'Clean Energy. Clean Future.',
        'sector'      => 'Renewable Biomass',
        'location'    => 'East Region, Cameroon',
        'stage'       => 'Pilot Operating',
        'capital'     => 'US$ 2.8M',
        'description' => 'Regenerative charcoal produced from fast-growing managed woodlots and agricultural residues — displacing forest-cut charcoal in urban cooking-fuel markets.',
        'accent'      => '#e87a28',
        'palette'     => 'charcoal',
        'motif'       => 'charcoal',
        'image'       => null,
    ],
    [
        'slug'        => 'solar-irrigation',
        'group'       => 'Water & AgTech',
        'number'      => '04',
        'title'       => 'Solar Irrigation Network',
        'tagline'     => 'Water Where It Works',
        'sector'      => 'AgTech & Water Infrastructure',
        'location'    => 'Far North Region, Cameroon',
        'stage'       => 'Structuring',
        'capital'     => 'US$ 6.5M',
        'description' => 'Distributed solar-powered irrigation serving smallholder cooperatives — converting seasonal farmland into year-round production across the Sahelian belt.',
        'accent'      => '#e5b94e',
        'palette'     => 'charcoal',
        'motif'       => 'solar',
        'image'       => null,
    ],
    [
        'slug'        => 'avocado-estate',
        'group'       => 'Horticulture',
        'number'      => '05',
        'title'       => 'Avocado Export Estate',
        'tagline'     => 'Highland Hass for Export',
        'sector'      => 'Horticulture & Export',
        'location'    => 'West Region, Cameroon',
        'stage'       => 'Land Secured',
        'capital'     => 'US$ 8M',
        'description' => 'A highland Hass avocado estate with packhouse and cold chain, purpose-built for European and Middle-Eastern counter-season export windows.',
        'accent'      => '#7ba05b',
        'palette'     => 'forest',
        'motif'       => 'avocado',
        'image'       => null,
    ],
    [
        'slug'        => 'community-energy',
        'group'       => 'Energy',
        'number'      => '06',
        'title'       => 'Community Renewable Energy',
        'tagline'     => 'Power for Productive Use',
        'sector'      => 'Distributed Energy',
        'location'    => 'Multi-Region, Cameroon',
        'stage'       => 'Development',
        'capital'     => 'US$ 10M',
        'description' => 'A mini-grid and rooftop solar portfolio delivering reliable power to agro-industrial sites — and to the communities that grow around them.',
        'accent'      => '#5fa8a0',
        'palette'     => 'charcoal',
        'motif'       => 'energy',
        'image'       => null,
    ],
    [
        'slug'        => 'agro-industrial-park',
        'group'       => 'Infrastructure',
        'number'      => '07',
        'title'       => 'Agro-Industrial Park',
        'tagline'     => 'Shared Industrial Backbone',
        'sector'      => 'Industrial Infrastructure',
        'location'    => 'Douala Corridor, Cameroon',
        'stage'       => 'Master-Planning',
        'capital'     => 'US$ 25M',
        'description' => 'A serviced industrial park clustering processing, logistics and cold storage for agricultural value chains — anchored by AfrilandCorp ventures and open to third-party operators.',
        'accent'      => '#b99a5b',
        'palette'     => 'forest',
        'motif'       => 'agropark',
        'image'       => null,
    ],
    [
        'slug'        => 'future-projects',
        'group'       => 'Pipeline',
        'number'      => '08',
        'title'       => 'Future Projects',
        'tagline'     => 'The Pipeline Ahead',
        'sector'      => 'Portfolio Pipeline',
        'location'    => 'Pan-African',
        'stage'       => 'Open to Partners',
        'capital'     => 'Rolling',
        'description' => 'A structured pipeline of new ventures in food security, clean energy and industrial import substitution — developed with operating partners and co-investors.',
        'accent'      => '#d8c27a',
        'palette'     => 'charcoal',
        'motif'       => 'future',
        'image'       => null,
    ],
];
