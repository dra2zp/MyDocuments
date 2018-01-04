package inclass;

import static org.junit.Assert.*;

import org.junit.Test;

/**
 * D.J. Anderson
 * dra2zp
 * Assignment 2
 */

public class CalTest {

	@Test
	public void testSameMonth() {
		int m1 = 3;
		int d1 = 14;
		int m2 = 3;
		int d2 = 25;
		int y = 2017;
		int n = Cal.cal(m1, d1, m2, d2, y);
		assertEquals("month2 == month1", 11, n);
	}
	
	@Test
	public void testDifferentMonth() {
		int m1 = 7;
		int d1 = 11;
		int m2 = 11;
		int d2 = 4;
		int y = 2017;
		int n = Cal.cal(m1, d1, m2, d2, y);
		assertEquals("month2 != month1", 116, n);
	}
	
	@Test
	public void testYearNoDivide4() {
		int m1 = 1;
		int d1 = 1;
		int m2 = 7;
		int d2 = 11;
		int y = 2017;
		int n = Cal.cal(m1, d1, m2, d2, y);
		assertEquals("y % 4 != 0", 191, n);
	}
	
	@Test
	public void testYearDivide4() {
		int m1 = 1;
		int d1 = 1;
		int m2 = 12;
		int d2 = 8;
		int y = 2016;
		int n = Cal.cal(m1, d1, m2, d2, y);
		assertEquals("y % 4 == 0", 342, n);
	}
	
	@Test
	public void testYearDivide100Not400() {
		int m1 = 2;
		int d1 = 14;
		int m2 = 3;
		int d2 = 14;
		int y = 1900;
		int n = Cal.cal(m1, d1, m2, d2, y);
		assertEquals("y % 100 == 0 && y % 400 != 0", 28, n);
	}
	
	@Test
	public void testYearDivide100And400() {
		int m1 = 2;
		int d1 = 2;
		int m2 = 4;
		int d2 = 1;
		int y = 2000;
		int n = Cal.cal(m1, d1, m2, d2, y);
		assertEquals("y % 100 == 0 && y % 400 == 0", 59, n);
	}
	
	@Test
	public void testYearNoDivide100No400() {
		int m1 = 1;
		int d1 = 20;
		int m2 = 9;
		int d2 = 1;
		int y = 13;
		int n = Cal.cal(m1, d1, m2, d2, y);
		assertEquals("y % 100 != 0 && y % 400 != 0", 224, n);
	}
	
	@Test
	public void testSameDay() {
		int m1 = 1;
		int d1 = 16;
		int m2 = 9;
		int d2 = 16;
		int y = 2017;
		int n = Cal.cal(m1, d1, m2, d2, y);
		assertEquals("d1 == d2", 243, n);
	}
	
	@Test
	public void testLowBounds() {
		int m1 = 1;
		int d1 = 1;
		int m2 = 11;
		int d2 = 8;
		int y = 1;
		int n = Cal.cal(m1, d1, m2, d2, y);
		assertEquals("Low bounds", 311, n);
	}
	
	@Test
	public void testZeroDays() {
		int m1 = 12;
		int d1 = 25;
		int m2 = 12;
		int d2 = 25;
		int y = 2017;
		int n = Cal.cal(m1, d1, m2, d2, y);
		assertEquals("Zero days between dates", 0, n);
	}

}
