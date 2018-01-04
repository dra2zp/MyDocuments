/*
 * Test Name: test_convert
 * Subject Web link: 
 * 
 * Methodology:
 * input domain partition:
 * 
 * For base choice criterion, need following tests:
 * 
 */



import org.junit.*;

import static net.sourceforge.jwebunit.junit.JWebUnit.*;
import net.sourceforge.jwebunit.junit.WebTester;
import static org.junit.Assert.assertEquals;


public class test_convert 
{
	private WebTester tester;

	@Before
	public void prepare() 
	{
        tester = new WebTester();
        tester.setBaseUrl("http://plato.cs.virginia.edu/~up3f/php");
	}

	@After
	public void teardown()
	{
		tester.closeBrowser();
	}
	
	@Test
	public void test0() 
	{
		tester.beginAt("convert.php");
		tester.assertTitleEquals("Measurement Conversion");
	}
		
	/*
	 * Test case number: 1 Test case values: 1,1,1,1,1,1,1,1,1,1,1,1,1,1 convert
	 * (base) Expected output (Post-state): results include
	 * 
	 * 1.0 Fº = -17.22 Cº 1.0 Cº = 33.8 Fº 1.0 in = 2.54 cm 1.0 cm = 0.39 in 1.0
	 * ft = 0.3 m 1.0 m = 3.28 ft 1.0 mi = 1.61 km 1.0 km = 0.62 mi 1.0 gal =
	 * 3.79 L 1.0 L = 0.26 gal 1.0 oz = 28.35 g 1.0 g = 0.04 oz 1.0 lb = 0.45 kg
	 * 1.0 kg = 2.21 lb
	 */
	@Test
	public void test1() {
		tester.beginAt("convert.php");
		tester.assertTitleEquals("Measurement Conversion");
		tester.setTextField("F", "1");
		tester.setTextField("C", "1");
		tester.setTextField("in", "1");
		tester.setTextField("cm", "1");
		tester.setTextField("ft", "1");
		tester.setTextField("m", "1");
		tester.setTextField("mi", "1");
		tester.setTextField("km", "1");
		tester.setTextField("gal", "1");
		tester.setTextField("L", "1");
		tester.setTextField("oz", "1");
		tester.setTextField("g", "1");
		tester.setTextField("lb", "1");
		tester.setTextField("kg", "1");
		tester.submit();
		tester.assertTextPresent("-17.22 C");   
		tester.assertTextPresent("33.80 F");
		tester.assertTextPresent("2.54 cm");     
		tester.assertTextPresent("0.39 in");
		tester.assertTextPresent("0.30 m");
		tester.assertTextPresent("3.28 ft");
		tester.assertTextPresent("1.61 km");
		tester.assertTextPresent("0.62 mi");
		tester.assertTextPresent("3.79 L");
		tester.assertTextPresent("0.26 gal");
		tester.assertTextPresent("28.35 g");
		tester.assertTextPresent("0.04 oz");
		tester.assertTextPresent("0.45 kg");
		tester.assertTextPresent("2.21 lb");
	}

}
