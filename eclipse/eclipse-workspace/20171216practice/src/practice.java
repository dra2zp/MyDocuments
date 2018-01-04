import java.util.ArrayList;
import java.util.Random;

public class practice {

	public static void main(String[] args) {
		// TODO Auto-generated method stub

	}
	
	// fibonacci is a function that takes in an int k and
	// returns the first k numbers in the fibonacci sequence
	public static String fibonacci(int k) {
		if (k < 1) {
			return "";
		}
		else if (k == 1) {
			return "0";
		}
		else if (k == 2) {
			return "0, 1";
		}
		else {
			int num1 = 0;
			int num2 = 1;
			int count = 3;
			int sum = num1 + num2;
			String list = Integer.toString(num1) + ", " +
			Integer.toString(num2) + ", " +
					Integer.toString(sum);
			while (count < k) {
				num1 = num2;
				num2 = sum;
				sum = num1 + num2;
				list += ", " + Integer.toString(sum);
				count++;
			}
			return list;
		}
	}
	
	// pascal is a function that takes in an int k and returns
	// the k-th row in the pascal triangle
	public static String pascal(int k) {
		if (k < 1) {
			return "";
		}
		else if (k == 1) {
			return "1";
		}
		else if (k == 2) {
			return "1 1";
		}
		else {
			int countArrays = 3;
			ArrayList< ArrayList<Integer> > total = new
					ArrayList< ArrayList<Integer> >();
			int countNum = 0;
			int countArray = 0;
			ArrayList<Integer> array = new
					ArrayList<Integer>();
			while (countNum < k) {
				array.add(1);
				countNum++;
			}
			total.add(array);
			countArray++;
			while (countArray <= k / 2) {
				countNum = 0;
				array = new ArrayList<Integer>();
				int num = 1;
				while (countNum < k - countArray) {
					array.add(num);
					num += total.get(countArray - 1).get(countNum + 1);
					countNum++;
				}
				total.add(array);
				countArray++;
			}
			String list = "";
			int totalCount = 0;
			int arrayCount = k - 1;
			while (totalCount < (k / 2) + 1) {
				list += Integer.toString(total.get(totalCount).get(arrayCount))
						+ " ";
				totalCount++;
				arrayCount--;
			}
			if (k % 2 == 1) {
				totalCount = (k / 2) - 1;
			}
			else {
				totalCount = (k / 2) - 2;
			}
			arrayCount = k - 1 - totalCount;
			while (totalCount > -1) {
				list += Integer.toString(total.get(totalCount).get(arrayCount))
						+ " ";
				totalCount--;
				arrayCount++;
			}
			return list;
		}
	}
	
	// pigLatin is a function that takes a String str and
	// returns the str translated in pig latin
	public static String pigLatin(String str) {
		String[] strArray = str.split(" ");
		String translated = "";
		ArrayList<String> translatedPhrase = new
				ArrayList<String>();
		for (int i = 0; i < strArray.length; i++) {
			translated = "";
			if (strArray[i].length() < 2) {
				translated = strArray[i];
			}
			else {
				for (int j = 1; j < strArray[i].length(); j++) {
					translated += strArray[i].charAt(j);
				}
				translated += strArray[i].charAt(0);
				translated += "ay";
			}
			translatedPhrase.add(translated);
		}
		String pig = "";
		for (int i = 0; i < translatedPhrase.size(); i++) {
			pig += translatedPhrase.get(i);
			pig += " ";
		}
		return pig;
	}
	
	// wordFrame is a function that takes in an
	// ArrayList<String> stringList and returns each string in
	// stringList with a border of asterisks (*) around it
	public static void wordFrame(ArrayList<String> stringList) {
		int k = stringList.size();
		int longest = 0;
		for (int i = 0; i < k; i++) {
			if (stringList.get(i).length() > longest) {
				longest = stringList.get(i).length();
			}
		}
		int frameLength = longest + 4;
		for (int i = 0; i < frameLength - 1; i++) {
			System.out.print("*");
		}
		System.out.print("*\n");
		for (int i = 0; i < k; i++) {
			System.out.print("* " + stringList.get(i));
			for (int j = 0; j < frameLength - stringList.get(i).length() - 3; j++) {
				System.out.print(" ");
			}
			System.out.print("*\n");
		}
		for (int i = 0; i < frameLength - 1; i++) {
			System.out.print("*");
		}
		System.out.print("*\n");
	}
	
	// digitList is a function that takes in an int k and
	// returns all the digits in k as an array
	public static ArrayList<Integer> digitList(int k) {
		String number = Integer.toString(k);
		ArrayList<Integer> list = new ArrayList<Integer>();
		for (int i = 0; i < number.length(); i++) {
			list.add(Character.getNumericValue(number.charAt(i)));
		}
		return list;
	}
	
	// rotateList is a function that takes in an
	// ArrayList<Integer> list and an int k and returns the
	// list rotated by k elements
	public static ArrayList<Integer> rotateList(ArrayList<Integer> list, int k) {
		ArrayList<Integer> rotated = new ArrayList<Integer>();
		int index = k;
		int size = list.size();
		while (index < size) {
			rotated.add(list.get(index));
			index++;
		}
		index = 0;
		while (index < k) {
			rotated.addAll(list.get(index));
			index++;
		}
		return rotated;
	}
	
	// mergeLists is a recursive function that takes in two
	// ArrayList<Integer> list1 and list2 and an initially
	// empty ArrayList<Integer> merged and returns a single
	// sorted list merged
	public static ArrayList<Integer> mergeLists(ArrayList<Integer> list1, ArrayList<Integer> list2, ArrayList<Integer> merged) {
		int size1 = list1.size();
		int size2 = list2.size();
		int sizeMerged = merged.size();
		if (size1 == 0 && size2 == 0) {
			return merged;
		}
		else if (size1 == 0) {
			for (int i = 0; i < size2; i++) {
				merged.add(list2.get(i));
			}
			return merged;
		}
		else if (size2 == 0) {
			for (int i = 0; i < size1; i++) {
				merged.add(list1.get(i));
			}
			return merged;
		}
		else {
			if (list1.get(0) < list2.get(0)) {
				merged.add(list1.get(0));
				ArrayList<Integer> newList1= new ArrayList<Integer>();
				for (int i = 1; i < size1; i++) {
					newList1.add(list1.get(i));
				}
				list1 = newList1;
			}
			else if (list2.get(0) < list1.get(0)) {
				merged.add(list2.get(0));
				ArrayList<Integer> newList2 = new ArrayList<Integer>();
				for (int i = 1; i < size1; i++) {
					newList2.add(list2.get(i));
				}
				list2 = newList2;
			}
			else {
				merged.add(list1.get(0));
				merged.add(list2.get(0));
				ArrayList<Integer> newList1 = new ArrayList<Integer>();
				ArrayList<Integer> newList2 = new ArrayList<Integer>();
				for (int i = 1; i < size1; i++) {
					newList1.add(list1.get(i));
				}
				for (int i = 1; i < size2; i++) {
					newList2.add(list2.get(i));
				}
				list1 = newList1;
				list2 = newList2;
			}
			return mergeLists(list1, list2, merged);
		}
	}
	
	// isPalindrome is a function that takes in a String
	// input and returns true if input is a palindrome and
	// false otherwise
	public static boolean isPalindrome(String input) {
		int first = 0;
		int last = input.length() - 1;
		while (first < last) {
			if (input.charAt(first) != input.charAt(last)) {
				return false;
			}
			first++;
			last--;
		}
		return true;
	}
	
	// guessPassword is a function that takes in a String
	// password and returns an int counter showing the
	// number of guesses it would take to guess that password
	// using a brute-force technique
	public static int guessPassword(String password) {
		char[] characters= {'A', 'B', 'C', 'D', 'E', 'F', 'G',
		                    'H', 'I', 'J', 'K', 'L', 'M', 'N',
		                    'O', 'P', 'Q', 'R', 'S', 'T', 'U',
		                    'V', 'W', 'X', 'Y', 'Z', 'a', 'b',
		                    'c', 'd', 'e', 'f', 'g', 'h', 'i',
		                    'j', 'k', 'l', 'm', 'n', 'o', 'p',
		                    'q', 'r', 's', 't', 'u', 'v', 'w',
		                    'x', 'y', 'z', '1', '2', '3', '4',
		                    '5', '6', '7', '8', '9', '0', '!',
		                    '@', '#', '$', '%', '^', '&', '*',
		                    '(', ')'};
		int counter = 0;
		int size = characters.length;
		String str = "";
		for (int i = 0; i < size; i++) {
			str += characters[i];
			for (int j = 0; j < size; j++) {
				str += characters[j];
				for (int k = 0; k < size; k++) {
					str += characters[k];
					for (int l = 0; l < size; l++) {
						str += characters[l];
						counter++;
						System.out.println(str);
						if (str.equals(password)) {
							return counter;
						}
						String newStr = "";
						for (int m = 0; m < 3; m++) {
							newStr += str.charAt(m);
						}
						str = newStr;
					}
					String newStr = "";
					for (int n = 0; n < 2; n++) {
						newStr += str.charAt(n);
					}
					str = newStr;
				}
				String newStr = "";
				for (int o = 0; o < 1; o++) {
					newStr += str.charAt(o);
				}
				str = newStr;
			}
			str = "";
		}
		return -1;
	}
	
	// numMovesOptimized is a function that takes in an int
	// dimension, an int[] queenPos that contains two elements
	// for the queen's x- and y-position (respectively), and
	// an int[][] bad that contains a list of (x, y)-pairs
	// that are invalid for the queen to travel to
	public static int numMovesOptimized(int dim, int[] queenPos, int[][] bad) {
		int num = 0;
		int[][] grid = new int[dim][dim];
		for (int i = 0; i < bad.length; i++) {
			int x = bad[i][0];
			int y = bad[i][1];
			grid[x - 1][y - 1] = 1;
		}
		int xQueen = queenPos[0];
		int yQueen = queenPos[1];
		int counter = 0;
		int xTemp;
		int yTemp;
		// west
		xTemp = xQueen;
		yTemp = yQueen;
		xTemp--;
		while (xTemp > 0 && grid[xTemp - 1][yTemp - 1] == 0) {
			counter++;
			xTemp--;
		}
		// east
		xTemp = xQueen;
		yTemp = yQueen;
		xTemp++;
		while (xTemp <= dim && grid[xTemp - 1][yTemp - 1] == 0) {
			counter++;
			xTemp++;
		}
		// south
		xTemp = xQueen;
		yTemp = yQueen;
		yTemp--;
		while (yTemp > 0 && grid[xTemp - 1][yTemp - 1] == 0) {
			counter++;
			yTemp--;
		}
		// north
		xTemp = xQueen;
		yTemp = yQueen;
		yTemp++;
		while (yTemp <= dim && grid[xTemp - 1][yTemp - 1] == 0) {
			counter++;
			yTemp++;
		}
		// southwest
		xTemp = xQueen;
		yTemp = yQueen;
		xTemp--;
		yTemp--;
		while (xTemp > 0 && yTemp > 0 && grid[xTemp - 1][yTemp - 1] == 0) {
			counter++;
			xTemp--;
			yTemp--;
		}
		// northeast
		xTemp = xQueen;
		yTemp = yQueen;
		xTemp++;
		yTemp++;
		while (xTemp <= dim && yTemp <= dim && grid[xTemp - 1][yTemp - 1] == 0) {
			counter++;
			xTemp++;
			yTemp++;
		}
		// northwest
		xTemp = xQueen;
		yTemp = yQueen;
		xTemp--;
		yTemp++;
		while (xTemp > 0 && yTemp <= dim && grid[xTemp - 1][yTemp - 1] == 0) {
			counter++;
			xTemp--;
			yTemp++;
		}
		// southeast
		xTemp = xQueen;
		yTemp = yQueen;
		xTemp++;
		yTemp--;
		while (xTemp <= dim && yTemp > 0 && grid[xTemp - 1][yTemp - 1] == 0) {
			counter++;
			xTemp++;
			yTemp--;
		}
		return counter;
	}
	
	// rand5 is a function that generates a random number
	// from 1 to 5
	public static int rand5() {
		Random r = new Random();
		return (r.nextInt(5) + 1);
	}
	
	// rand7 is a function that generates a random number
	// from 1 to 7 using the rand5 function
	public static int rand7() {
		int sum = rand5() + rand5() + rand5() + rand5() +
				rand5() + rand5() + rand5();
		return (sum % 7) + 1;
	}
	
	// randProb is a function that shows that rand5 and
	// rand7 are truly random
	public static void randProb() {
		int r5count1 = 0;
		int r5count2 = 0;
		int r5count3 = 0;
		int r5count4 = 0;
		int r5count5 = 0;
		int r7count1 = 0;
		int r7count2 = 0;
		int r7count3 = 0;
		int r7count4 = 0;
		int r7count5 = 0;
		int r7count6 = 0;
		int r7count7 = 0;
		int count = 0;
		while (count < 1000000) {
		  int num5 = rand5();
		  int num7 = rand7();
		  if (num5 == 1) {
		    r5count1++;
		  }
		  else if (num5 == 2) {
		    r5count2++;
		  }
		  else if (num5 == 3) {
		    r5count3++;
		  }
		  else if (num5 == 4) {
		    r5count4++;
		  }
		  else if (num5 == 5) {
		    r5count5++;
		  }
		  if (num7 == 1) {
		    r7count1++;
		  }
		  else if (num7 == 2) {
		    r7count2++;
		  }
		  else if (num7 == 3) {
		    r7count3++;
		  }
		  else if (num7 == 4) {
		    r7count4++;
		  }
		  else if (num7 == 5) {
		    r7count5++;
		  }
		  else if (num7 == 6) {
		    r7count6++;
		  }
		  else if (num7 == 7) {
		    r7count7++;
		  }
		  count++;
		}
		System.out.println(r5count1*100/200000);
		System.out.println(r5count2*100/200000);
		System.out.println(r5count3*100/200000);
		System.out.println(r5count4*100/200000);
		System.out.println(r5count5*100/200000);
		System.out.println(r7count1*100/142857);
		System.out.println(r7count2*100/142857);
		System.out.println(r7count3*100/142857);
		System.out.println(r7count4*100/142857);
		System.out.println(r7count5*100/142857);
		System.out.println(r7count6*100/142857);
		System.out.println(r7count7*100/142857);
	}

}
