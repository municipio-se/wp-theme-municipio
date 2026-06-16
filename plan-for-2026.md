# Plan for LTS 2026

Bas: `4.25.0`. Nuvarande LTS-head: `bc105ad85`. Ny upstream-bas: `7.7.18`.

## Slutsats

Rebasen bör göras som en ny LTS-anpassning ovanpå `7.7.18`, inte som
cherry-pick av gamla view- och helperpatchar. Temat får också bära inbäddad
`Modularity/`, vilket påverkar arbetet med den tidigare separata
Modularity-pluginen.

## Arbetsplan

- [ ] Starta från upstream `7.7.18`.
- [ ] Acceptera upstreams nya PHP-, service- och Modularity-struktur.
- [ ] Lägg först LTS Composer-identitet, licens och eventuell `replace`-strategi.
- [ ] Återskapa säkerhetsdefaults för custom code och avancerad HTML.
- [ ] Porta de Modularity-säkerhetsfixar och sökindexfixar som beslutats i
      `wp-plugin-modularity/plan-for-2026.md`.
- [ ] Skapa en lista över faktiskt använda LTS-filter och återinför bara dem.
- [ ] Verifiera design-/viewbeteenden mot nya styleguide-komponenter.
- [ ] Låt build-, språk- och assetfiler genereras av rätt verktyg efter rebasen.

## Beslutstabell

| Område | Vår slutändring | Upstream-läge | Bedömning | Berörda commits |
| --- | --- | --- | --- | --- |
| Composer och paketering | Bytte till `municipio/wp-theme-municipio`, GPL, installer-name och LTS-beroendeyta. | `7.7.18` heter `helsingborg-stad/municipio`, kräver PHP 8.2 och många nya upstreampaket. | Återskapa smalare | `c5d884979`, `af68dddc7`, `b1897ac48`, `812763da`, `a418f2628` |
| Composer-kompatibilitet mot plugins | LTS-temat är tänkt som Municipio-providern. | `wp-plugin-hbg-event-manager-integration` `3.1.4` kräver `helsingborg-stad/municipio`. | Återskapa med `replace` eller metapaketstrategi | beroendeanalys mot integrationen |
| Inbyggd Modularity | LTS hade separat plugin i workspacet. | `7.7.18` autoloadar `Modularity\\` från temat. | Ersätt med upstreams struktur | upstream `composer.json` |
| Custom code och avancerad HTML | Stängde av custom code och avancerade HTML-tags som default, med filter för opt-in. | `7.7.18` skriver fortfarande ut custom code utan `Municipio/allowCustomCode` och saknar LTS-filter för avancerad HTML i grep. | Behåll/återskapa smalare | `a3b5583bc`, `50d4823e8`, `fafe26c99`, `f019b3f7f` |
| Inline script CSP | Lade `wp_inline_script_attributes` på flera inline scripts. | `7.7.18` saknar flera av LTS-fixarna i gamla ytor. | Behåll där inline scripts finns kvar | `2ff6ae736` och relaterade CSP-fixar |
| Hookar runt artikelinnehåll | Lade `articleContentBefore` och `articleContentAfter`. | `7.7.18` har redan `articleContentBefore` och `articleContentAfter` via `BaseController`. | Släpp | `7ca3c5fc0`, `a5a67a76d` |
| Publika filter för extensibility | Lade bland annat filter för sökresultatets site name, tom excerpt, search validation, archive styles, custom post type args, sidebar classes, button field args, navigation menuId och page-centered content area. | Vissa finns upstream (`articleContentBefore/After`, `CustomPostType/labels`), flera saknas i `7.7.18`. | Återskapa smalare per faktisk kundanvändning | `6982c79c`, `34d403bf3`, `f191948d1`, `4b000502d`, `09b2053fc`, `f2ffe30f3`, `ed8f9fb66`, `3c7858d8c`, `dc146ee7f`, `39d8dfd02` |
| Prefill av ikoner | Anpassade `PrefillIconChoice` för egna ikonkällor. | Upstream har nyare icon/styleguide-yta. | Verifiera manuellt | `e09215612`, `9445c9a1b`, `b688e5dd2` |
| Söktemplate och title-tag | Fixade fel template och theme support för title-tag. | Upstream har nyare template/controller- och theme support-struktur. | Ersätt | `1be5d261e`, `0954a7bbc`, `5d77cd135` |
| Legacy DB och prestanda | Lade legacy DB-fixar, cache och snabbare default post type-hämtning. | Upstream har omfattande arkitektur- och serviceförändringar. | Verifiera manuellt, ersätt där upstream täcker | `673f7a859`, `d38b16db3`, `2d8ce2d99`, `997116eeb` |
| ReadSpeaker och widgetytor | Justerade ReadSpeaker-id, under-hero widget area, one-page och secondary nav. | Motsvarande LTS-yta saknas eller är flyttad i `7.7.18`. | Verifiera manuellt/återskapa smalare | `9fb2590c2`, `bbfd1503f`, `d291a9201`, `6c9e20600`, `82ea2e19b`, `382b6cc5b`, `c289c17e4`, `7dd6e4af0`, `14eecc4ff` |
| Bildalttextvalidering | LTS exponerade `getAltText`-relaterad kontroll. | `7.7.18` har `ImageAltTextValidation`, men `getAltText()` är privat. | Verifiera manuellt | relaterade alttextcommits |
| Markup, design tokens och viewpatchar | Många LTS-viewändringar i header, drawer, archive, sidebar, caption, tags och footer. | `7.7.18` har ny styleguide och ombyggda views. | Ersätt, återinför bara saknade beteenden | många viewcommits |
| Assets, språk, builds och releasefiler | Byggde assets, tog bort instantpage, ändrade package assets och dokumentation. | Ska inte flyttas manuellt. | Ej relevant | build-/asset-/docscommits |

## Risker att verifiera

- PHP 8.2-kravet i upstream kan påverka LTS-miljöer.
- `helsingborg-stad/municipio`-beroenden i andra paket behöver Composer-lösning.
- Custom code är ett säkerhetsbeslut; upstreams default skiljer sig från LTS.
- Inbyggd `Modularity/` kan krocka med separat pluginstrategi i LTS-bundlet.
- Många gamla viewpatchar har bytt kontext och måste funktionstestas i stället
  för att cherry-pickas.
- Språkfiler och byggda assets ska uppdateras manuellt med ordinarie verktyg
  efter implementation, inte i rebaserapporten.

## Analyskommandon

- `git diff --stat 4.25.0..HEAD`
- `git diff --stat 4.25.0..7.7.18`
- `git diff --stat HEAD..7.7.18`
- `git log --reverse --format='%h%x09%ad%x09%s' --date=short 4.25.0..HEAD`
- `git log --reverse --format='%h%x09%ad%x09%s' --date=short 4.25.0..7.7.18`
- Riktade `git diff`, `git show` och `git grep` för Composer, theme support,
  custom code, CSP, post type-filter, navigation, article hooks, search views,
  ReadSpeaker, widgetytor, Modularity och styleguide-relaterade ytor.
