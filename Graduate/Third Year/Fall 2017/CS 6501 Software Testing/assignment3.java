/** D.J. Anderson
 *  dra2zp
 *  Assignment 3
 *  assignment3.java
 */

package inclass;

public class assignment3 {

	public static boolean eq(char[] c1, char[] c2, boolean case_sensitive) {
		if (case_sensitive) {
			return (String.valueOf(c1).equals(String.valueOf(c2)));
		}
		else {
			return (String.valueOf(c1).equalsIgnoreCase(String.valueOf(c2)));
		}
	}
	
	public static void main(String[] args) {
		
	}

}
