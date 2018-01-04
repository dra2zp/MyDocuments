/** D.J. Anderson
 *  dra2zp
 *  Assignment 3
 *  assignment3Test.java
 */

package inclass;

import static org.junit.Assert.*;

import org.junit.Test;

public class assignment3Test {

	@Test
	public void testDifferentStringsCaseSensitive() {
		String s1 = "Hello";
		String s2 = "world";
		char[] c1 = s1.toCharArray();
		char[] c2 = s2.toCharArray();
		boolean n = assignment3.eq(c1, c2, true);
		assertFalse(n);
	}
	
	@Test
	public void testDifferentStringsNotCaseSensitive() {
		String s1 = "Hello";
		String s2 = "world";
		char[] c1 = s1.toCharArray();
		char[] c2 = s2.toCharArray();
		boolean n = assignment3.eq(c1, c2, false);
		assertFalse(n);
	}
	
	@Test
	public void testUppercaseLowercaseCaseSensitive() {
		String s1 = "Hello";
		String s2 = "hello";
		char[] c1 = s1.toCharArray();
		char[] c2 = s2.toCharArray();
		boolean n = assignment3.eq(c1, c2, true);
		assertFalse(n);
	}
	
	@Test
	public void testUppercaseLowercaseNotCaseSensitive() {
		String s1 = "Hello";
		String s2 = "hello";
		char[] c1 = s1.toCharArray();
		char[] c2 = s2.toCharArray();
		boolean n = assignment3.eq(c1, c2, false);
		assertTrue(n);
	}
	
	@Test
	public void testIdenticalStringsCaseSensitive() {
		String s1 = "world";
		char[] c1 = s1.toCharArray();
		boolean n = assignment3.eq(c1, c1, true);
		assertTrue(n);
	}
	
	@Test
	public void testIdenticalStringsNotCaseSensitive() {
		String s1 = "world";
		char[] c1 = s1.toCharArray();
		boolean n = assignment3.eq(c1, c1, false);
		assertTrue(n);
	}
	
	@Test
	public void testSameStringsCaseSensitive() {
		String s1 = "world";
		String s2 = "world";
		char[] c1 = s1.toCharArray();
		char[] c2 = s2.toCharArray();
		boolean n = assignment3.eq(c1, c2, true);
		assertTrue(n);
	}
	
	@Test
	public void testSameStringsNotCaseSensitive() {
		String s1 = "world";
		String s2 = "world";
		char[] c1 = s1.toCharArray();
		char[] c2 = s2.toCharArray();
		boolean n = assignment3.eq(c1, c2, false);
		assertTrue(n);
	}
	
	@Test
	public void testEmptyStringsCaseSensitive() {
		String s1 = "";
		String s2 = "";
		char[] c1 = s1.toCharArray();
		char[] c2 = s2.toCharArray();
		boolean n = assignment3.eq(c1, c2, true);
		assertTrue(n);
	}
	
	@Test (expected = NullPointerException.class)
	public void testNullStringsNotCaseSensitive() {
		assignment3.eq(null, null, false);
	}

}
