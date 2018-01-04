package inclass;

import static org.junit.Assert.*;
import org.junit.Test;

public class ArrayOperationsNumZeroTest 
{
   @Test
   public void testNumZeroEmptyArray() 
   {
      int x[] = {};     // zero-sized array
      int n = ArrayOperations.numZero(x);
      assertEquals("0 zeros", 0, n);      
   }
   
   @Test
   public void testNumZeroArrayWithNoZeros()
   {
      int[] x = {1, 2, 3}; 
      int n = ArrayOperations.numZero(x);
      assertEquals("0 zeros in an array with no zeros", 0, n);
   }


}


