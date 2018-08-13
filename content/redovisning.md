---
...
Redovisning
=========================



Kmom01
-------------------------

**Hur känns det att hoppa rakt in i objekt och klasser med PHP, gick det bra och kan du relatera till andra objektorienterade språk?**

Det känns helt ok, har jobbat en del redan med objektorientering, det är rätt likt mellan alla språken. Så man fattar rätt snabbt hur saker ska vara uppbyggt. Efter att ha jobbat igenom ramverk1 och oopython, så har jag en stabil grund att stå på.

**Berätta hur det gick det att utföra uppgiften “Gissa numret” med GET, POST och SESSION?**

Gick helt okej, inte så svårt att utföra dessa tre sätten. Det är som att hämta data från en databas, fast det är bara inbyggt i PHP istället. Annars var det bara enkla funktioner och sånt man skulle använda sig utav. I princip sånt man redan kunde med andra ord.

**Har du några inledande reflektioner kring me-sidan och dess struktur?**

Väldigt konstigt uppbyggt med wrap och sånt. Det blev konflikter med Bootstrap som jag använder. Slutade med att jag fick ta bort wrap-sakerna som följde med exemplet. Nu ser det fint ut igen!

**Vilken är din TIL för detta kmom?**

Hade faktiskt ingen TIL i detta kmom, tyvärr. Då jag redan kunde det mesta som skulle göras i kursmomentet.





Kmom02
-------------------------

**Hur gick det att överföra spelet “Gissa mitt nummer” in i din me-sida?**

Det var inte så svårt efter att jag kollade på videon, den var till en stor hjälp eftersom artikeln inte svarade riktigt hur man skulle göra vissa saker. Lite hur vyerna och det fungerade, men det klarnade upp när jag kollade igenom videorna.

**Berätta om hur du löste uppgiften med Tärningsspelet 100, hur du tänkte, planerade och utförde uppgiften samt hur du organiserade din kod?**

Tyvärr så hade jag inte riktigt en plan. Såhär i efterhand hade nog varit bra med en liten strukturerad plan faktiskt, man är alltid efterklok!

Nu löste jag så att datorn bara spelar en runda och sparar sina poäng.
Jag fixade spelet genom att använda en blandning utav `session` och `post`.

**Berätta om din syn på modellering likt UML jämfört med verktyg som phpDocumentor.**
UML kan man göra i förväg för att få en överblick på vad man behöver för funktioner och klasser. När det gäller phpDocumentor så genereras dokumentationen efter man har skrivit all sin kod.

**Fördelar, nackdelar, användningsområde? Vad tycker du om konceptet make doc?**

Fördelen med auto-genererad dokumentation är att ”bara” behöver skriva det en gång, i filen du jobbar med. Sen kan alla beskåda dokumentationen via en auto-genererad sida. Nackdelen är att många ofta inte orkar skriva en docblock så det kan genereras efteråt.

**Hur känns det att skriva kod utanför och inuti ramverket, ser du fördelar och nackdelar med de olika sätten?**

Det är ibland enklare att skriva inuti ramverket, för då har man lite fler magiska funktioner som man kan använda. En av favoriterna är `$this->di->get(”url”)->create()`, vilket skapar en url länk relativt till vart du är, så man inte behöver tänka på att hoppa fram och tillbaka i mapparna när man ska skapa en länk.


**Vilken är din TIL för detta kmom?**

Märkte att Anax/Url inte läser in vilket protokoll som används, så går man in på en sida med https, så är länkarna skapade i vanliga http. Så det blir en massa ”mixed-content” errors. Det kan vara sönder på studentservern också, vet inte riktigt.

Har lärt mig att jag är dålig på att göra spel, spelar hellre de istället!




Kmom03
-------------------------

**Har du tidigare erfarenheter av att skriva kod som testar annan kod?**

Har gjort det tidigare i ramverk1, där man testar sin kod från en kommentarsmodul man har skapat själv. Där var det lite mer komplexa fall att utföra, men det gick till slut. Utöver det har jag nog inte hanterat enhetstester så mycket innan.

**Hur ser du på begreppen enhetstestning och att skriva testbar kod?**

Det är mycket fint att ha. För då slipper man testa själv om och om igen ifall man har ändrat en funktion. För man vet aldrig riktigt vad som kan gå sönder när man introducerar ny kod till systemet.

**Förklara kort begreppen white/grey/black box testing samt positiva och negativa tester, med dina egna ord.**

Whitebox är när man testar interna funktioner, så man kan se att allting i bakgrunden flyter på korrekt. Blackbox är när man testar utan att riktigt veta vad koden inom en funktion gör med en output, oftast testar man ett krav man har fått. Greybox är en blandning mellan white och black, syftet är att hitta defekter innan man släpper det till produktion till exempel.
Det positiva är att man hittar buggar och andra saker innan man släpper det skarpt. Det negativa är väl att det tar extra tid att skriva alla testerna.

**Hur gick det att genomföra uppgifterna med enhetstester, använde du egna klasser som bas för din testning?**

Det gick bra att testa, var inte så svåra fall att testa. Använde bara exempelkoden som fanns att testa mot. Mina egna klasser var snarlika skrivna, kändes inte så lönt att testa de då.

**Vilken är din TIL för detta kmom?**

Tydligen kan man testa exceptions, men när man tänker efter så är det rätt självklart. Jag har bara inte gjort det innan.




Kmom04
-------------------------

**Vilka är dina tankar och funderingar kring trait och interface?**

Jag förstår fortfarande inte riktigt vad trait och interface ska vara bra för. Den ärver men ärver ändå inte, man bara baserar det på en annan klass? Jag tror att lite fler exempel hur det fungerar skulle nog varit bra.

**Hur gick det att skapa intelligensen och taktiken till tärningsspelet, hur gjorde du?**

Jag gjorde en väldigt avancerad intelligens till min dator. Det hela går ut på att, om datorn har under 50 poäng så ska den försöka kasta tärningarna tre gånger. Om det är över 50 poäng så försöker den bara kasta en gång. Tänkte i tankarna att i början kan man spela lite mer aggressivt för att sedan trappa ner och köra på den säkra sidan.

**Några reflektioner från att integrera hårdare in i ramverkets klasser och struktur?**

Tycker det är smidigt att använda ramverkets funktioner, dock blir ju kodraderna lite längre för att man behöver kalla på olika saker för att nå fram. Fördelen är nog att man har inbyggd felhantering, givet att de som skapade ramverket har lagt in det.

**Berätta hur väl du lyckades med make test inuti ramverket och hur väl du lyckades att testa din kod med enhetstester och vilken kodtäckning du fick.**

Det gick bra att få in enhetstestning i ramverket. Efter har skrivit lite diverse tester, så gick det smidigt att göra dessa. Testade dock bara mot det jag har skrivit själv, så jag exkluderade Page och routemodulerna. Jag lyckades nå 100% kodtäckning, fick dock skriva en liten specialare för min funktion som låter datorn spela tärningsspelet.

**Vilken är din TIL för detta kmom?**

Vill man göra sin kod mer testbar, så kan man dela upp saker i mindre funktioner som är enklare att testa. Som tur så blev mina funktioner inte så gigantiska.



Kmom05
-------------------------

Här är redovisningstexten



Kmom06
-------------------------

Här är redovisningstexten



Kmom07-10
-------------------------

Här är redovisningstexten
