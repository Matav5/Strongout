# Strongout Fitness Planner - KPRI seminární práce

## Přehled
Strongout je webová aplikace pro plánování a sledování cvičebních rutin. Uživatelé mohou vytvářet, upravovat, mazat a zobrazovat cvičební plány a také je označovat jako oblíbené.

## Funkce
- **Přidání cvičebních plánů**: Vytváření nových cvičebních plánů s více tréninky a cviky.
- **Úprava cvičebních plánů**: Úprava existujících cvičebních plánů.
- **Mazání cvičebních plánů**: Odstranění cvičebních plánů.
- **Zobrazení cvičebních plánů**: Zobrazení detailů cvičebních plánů.
- **Oblíbené cvičební plány**: Označení cvičebních plánů jako oblíbené.

## Nastavení
### Předpoklady
- Docker
- Docker Compose

### Instalace
1. Naklonujte repozitář:
2. git clone https://github.com/Matav5/Strongout.git
3. cd Strongout
4. docker-compose up --build

5. Přístup k aplikaci:
    - Web: `http://localhost:9000` (musel jsem zvolit jiný port kvůli jiným aplikacím)
    - Adminer: `http://localhost:8080` (Správa databáze)

## Struktura souborů
- `www/html/`: Hlavní kód aplikace.
- `www/inc/`: Includy pro společné funkce.
- `www/xml/`: XML soubory pro cvičební plány.
- `www/html/public/`: CSS a JS + jiné assety
## Klíčové soubory
- `addPlan.php`: Přidání nových cvičebních plánů.
- `editPlan.php`: Úprava existujících cvičebních plánů.
- `deletePlan.php`: Mazání cvičebních plánů.
- `workouts.php`: Seznam a zobrazení cvičebních plánů.
- `upload.php`: Nahrávání cvičebních plánů pomocí XML.
- `favorite.php`: Správa oblíbených cvičebních plánů.

## Databáze
- MySQL databáze s tabulkami pro uživatele a oblíbené.
- "XML soubory"

## Použité technologie

### Backend
- **PHP**: Hlavní programovací jazyk pro serverovou logiku.
- **MySQL**: Databázový systém pro ukládání uživatelských dat a cvičebních plánů.

### Frontend
- **HTML**: Struktura webových stránek.
- **CSS**: Stylování webových stránek.
- **JavaScript**: Dynamická manipulace s obsahem stránek.

### Nástroje
- **Adminer**: Webové rozhraní pro správu databáze.
- **Tailwind CSS**: Utility-first CSS framework pro rychlé stylování.

### Další
- **Apache**: Webový server pro hostování PHP aplikace.

## Licence
Tento projekt je licencován pod licencí MIT.
